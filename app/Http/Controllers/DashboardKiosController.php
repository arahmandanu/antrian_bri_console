<?php

namespace App\Http\Controllers;

use App\Enum\CodeServiceEnum;
use App\Models\Codeservice;
use App\Models\FontColor;
use App\Models\FooterText;
use App\Models\OriginCustomer;
use App\Models\Properties;
use App\Models\TransactionParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardKiosController extends Controller
{
    public const IMAGE_EXTENSION = ['jpg', 'jpeg', 'giv', 'png', 'svg', 'webp'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listKios = scandir(public_path('/iklan_kios'));
        $gambar = [];
        foreach ($listKios as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::IMAGE_EXTENSION)) {
                array_push($gambar, $value);
            }
        }

        $footerTexts = FooterText::show()->kios()->get();
        $properties = Properties::first();
        $footerColorRecord = FontColor::where('name', '=', 'kios_footer_text_color')->first();

        $footerFlow = $properties ? $properties->footer_flow_kios ?? 'left' : 'left';
        $fotrColor = $footerColorRecord ? $footerColorRecord->value ?? 'white' : 'white';

        return view('kios.shared.main', [
            'listGambar' => $gambar,
            'footerTexts' => $footerTexts,
            'footer_flow' => $footerFlow,
            'fotrColor' => $fotrColor,
        ]);
    }

    public function printOnlineQueue(Request $request)
    {
        if (! $request->wantsJson() || empty($request->input('data'))) {
            $response = [
                'message' => 'Failed request!',
                'error' => true,
            ];
            $code = 405;
        } else {
            $barcode = $request->input('data');
            $date = substr($barcode, 0, 8);
            $companyId = substr($barcode, 8, 5);
            $unitService = substr($barcode, 13, 1);
            $antrian = substr($barcode, 14, 3);
            $barcodeUnit = substr($barcode, 17, 4);
            $currentTime = now();
            $properties = Properties::first();

            // // validate Date or online to local company
            if (empty($properties) || $properties->company_code != $companyId || $currentTime->format('dmY') !== $date) {
                $response = [
                    'message' => 'Cabang unit / tanggal tidak sesuai, silahkan ambil antrian baru!',
                    'error' => true,
                ];
                $code = 422;
            } else {
                // check apakah antrian masih bisa di panggil
                $exist = OriginCustomer::where('BaseDt', '=', $currentTime->format('Ymd'))
                    ->where('SeqNumber', '=', "$unitService$antrian")
                    ->where('UnitServe', '=', $unitService)
                    ->first();

                $codeService = Codeservice::where('Initial', '=', $unitService)->first();
                $lastCall = $codeService->last_queue;
                $validNumber = ((int) $antrian > $lastCall);

                if (empty($exist) && $validNumber === true) {
                    if (empty($barcodeUnit)) {
                        $trxParam = TransactionParam::where('UnitService', '=', $unitService == 'A' ? '01' : '02')->first();
                        $trxParamCode = $trxParam->TrxCode;
                        $trxParamService = $trxParam->Tservice;
                    } else {
                        $trxParam = TransactionParam::where('TrxCode', '=', $barcodeUnit)->first();
                        if (empty($trxParam)) {
                            $trxParamCode = $barcodeUnit;
                            $trxParamService = '00:00:00';
                        } else {
                            $trxParamCode = $trxParam->TrxCode;
                            $trxParamService = $trxParam->Tservice;
                        }
                    }

                    $currentTime = now();
                    $descTransaction = 'Antrian '.($request['unit_service'] == 'A' ? 'Teller' : 'CS');
                    $params = [
                        'BaseDt' => $currentTime->isoFormat('OYMMDD'),
                        'SeqNumber' => $unitService.$antrian,
                        'UnitServe' => $unitService,
                        'TimeTicket' => $currentTime->isoFormat('HH:mm:ss'),
                        'TimeCall' => null,
                        'WaitDuration' => null,
                        'Flag' => 'P',
                        'DescTransaksi' => $descTransaction,
                        'UnitCall' => $unitService,
                        'code_trx' => $trxParamCode,
                        'SLA_Trx' => $trxParamService,
                        'is_queue_online' => true,
                    ];

                    $splitAntrian = str_split($antrian);
                    if ($splitAntrian[0] != 0) {
                        $nextNumber = $antrian;
                    } elseif ($splitAntrian[1] != 0) {
                        $nextNumber = $splitAntrian[1].$splitAntrian[2];
                    } elseif ($splitAntrian[2] != 0) {
                        $nextNumber = $splitAntrian[2];
                    } else {
                        $response = [
                            'message' => 'Nomor antrian sudah expired, silahkan ambil nomor antrian baru!',
                            'error' => true,
                        ];
                        $code = 422;

                        return response()->json($response, $code);
                    }

                    $codeService->CurrentQNo = $nextNumber;
                    if (OriginCustomer::create($params) && $codeService->save()) {
                        $response = [
                            'message' => 'Sukses membuat antrian!',
                            'error' => false,
                        ];
                        $code = 201;
                        try {
                            $this->execPrint($currentTime, $descTransaction, $unitService.$antrian, $properties);
                        } catch (\Throwable $th) {
                            $response = [
                                'message' => 'Printer belum siap digunakan!',
                                'error' => true,
                            ];
                            $code = 422;
                        }
                    } else {
                        $response = [
                            'message' => 'Gagal membuat antrian!',
                            'error' => true,
                        ];
                        $code = 503;
                    }
                } else {
                    $response = [
                        'message' => 'Nomor antrian sudah expired, silahkan ambil nomor antrian baru!',
                        'error' => true,
                    ];
                    $code = 422;
                }
            }
        }

        return response()->json($response, $code);
    }

    public function createAntrian(Request $request)
    {
        if ($request->wantsJson()) {
            $properties = Properties::first();
            if (! $properties) {
                $response = [
                    'message' => 'Pastikan printer siap digunakan!',
                    'error' => true,
                ];
                $code = 503;
            } else {
                $usePrinter = env('PRINTER_ENABLED', true);
                if ($properties->printer_name == null && ! $usePrinter) {
                    $response = [
                        'message' => 'Pastikan printer siap digunakan!',
                        'error' => true,
                    ];
                    $code = 503;
                } else {
                    Validator::make($request->all(), [
                        'trx_param' => 'required|exists:trxparam,TrxCode',
                        'unit_service' => 'required|in:A,B',
                    ])->validate();

                    $currentQue = Codeservice::where('Initial', '=', $request['unit_service'])->first();
                    $trxParam = TransactionParam::where('TrxCode', '=', $request['trx_param'])->first();
                    if ($currentQue) {
                        $currentTime = now();
                        // Use Online First
                        $responseFromServer = $this->generateNumberQueueOnlineOffline($properties, $request->trx_param, $request->unit_service, $currentTime);
                        if ($responseFromServer[0] == true) {
                            // Todo adjust to get pure queue number
                            $nextNumber = $responseFromServer[1];
                            $myQueue = $responseFromServer[1];
                        } else {
                            $nextNumber = $currentQue->CurrentQNo + 1;
                            $myQueue = self::formatQueue($nextNumber);
                        }

                        $unitNextNumber = $request['unit_service'].$myQueue;
                        $descTransaction = 'Antrian '.($request['unit_service'] == 'A' ? 'Teller' : 'CS');
                        $params = [
                            'BaseDt' => $currentTime->isoFormat('OYMMDD'),
                            'SeqNumber' => $unitNextNumber,
                            'UnitServe' => $request['unit_service'],
                            'TimeTicket' => $currentTime->isoFormat('HH:mm:ss'),
                            'TimeCall' => null,
                            'WaitDuration' => null,
                            'Flag' => 'P',
                            'origin_queue_number' => $nextNumber,
                            'DescTransaksi' => $descTransaction,
                            'UnitCall' => $request['unit_service'],
                            'code_trx' => $request['trx_param'],
                            'SLA_Trx' => $trxParam->Tservice,
                        ];
                        $currentQue->CurrentQNo = $nextNumber;
                        $recordQueue = OriginCustomer::create($params);
                        if ($recordQueue && $currentQue->save()) {
                            $response = [
                                'message' => 'Sukses membuat antrian!',
                                'error' => false,
                            ];
                            $code = 201;

                            try {
                                $this->execPrint($currentTime, $descTransaction, $unitNextNumber, $properties);
                            } catch (\Throwable $th) {
                                $response = [
                                    'message' => 'Printer belum siap digunakan!',
                                    'error' => true,
                                ];
                                $code = 422;
                            }

                            $this->execSyncOfflineToOnline($properties, $recordQueue, $currentTime);
                        } else {
                            $response = [
                                'message' => 'Gagal membuat antrian!',
                                'error' => true,
                            ];
                            $code = 503;
                        }
                    } else {
                        $response = [
                            'message' => 'Unit service not found!',
                            'error' => true,
                        ];
                        $code = 404;
                    }
                }
            }
        } else {
            $response = [
                'message' => 'Failed request!',
                'error' => true,
            ];
            $code = 405;
        }

        return response()->json($response, $code);
    }

    public function menuMainIndex()
    {
        return view('kios.index', [
            'tellerCode' => CodeServiceEnum::TELLER,
            'CsCode' => CodeServiceEnum::CS,
        ]);
    }

    public function menuTeller()
    {
        return view('kios.teller', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', CodeServiceEnum::TELLER)->orderBy('TrxName', 'asc')->get(),
        ]);
    }

    public function menuCs()
    {
        return view('kios.cs', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', CodeServiceEnum::CS)->orderBy('TrxName', 'asc')->get(),
        ]);
    }
}
