<?php

namespace App\Http\Controllers;

use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\TransactionParam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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

        return view('kios.shared.main', [
            'listGambar' => $gambar,
        ]);
    }

    public function createAntrian(Request $request)
    {
        if ($request->wantsJson()) {
            Validator::make($request->all(), [
                'trx_param' => 'required|exists:trxparam,TrxCode',
                'unit_service' => 'required|in:A,B',
            ])->validate();

            $currentQue = Codeservice::where('Initial', '=', $request['unit_service'])->first();
            $trxParam = TransactionParam::where('TrxCode', '=', $request['trx_param'])->first();

            if ($currentQue) {
                $nextNumber = $currentQue->CurrentQNo + 1;
                $myQueue = self::formatQueue($nextNumber);
                $currentTime = now();
                $unitNextNumber = $request['unit_service'] . $myQueue;
                $params = [
                    'BaseDt' => $currentTime->isoFormat('OYMMDD'),
                    'SeqNumber' => $unitNextNumber,
                    'UnitServe' => $request['unit_service'],
                    'TimeTicket' => $currentTime->isoFormat('HH:mm:ss'),
                    'Flag' => 'P',
                    'DescTransaksi' => 'Antrian ' . ($request['unit_service'] == 'A' ? 'Teller' : 'CS'),
                    'UnitCall' => $request['unit_service'],
                    'code_trx' => $request['trx_param'],
                    'SLA_Trx' => $trxParam->Tservice,
                ];
                $currentQue->CurrentQNo = $nextNumber;
                if (OriginCustomer::create($params) && $currentQue->save()) {
                    $response = [
                        'message' => 'Sukses membuat antrian!',
                        'error' => false,
                    ];
                    $code = 201;
                    try {
                        $connector = new WindowsPrintConnector('POS-76C');
                        $printer = new Printer($connector);

                        $date = $currentTime->isoFormat('OY-MM-DD HH:mm:ss');
                        $printer->setJustification(Printer::JUSTIFY_CENTER);
                        $logo = EscposImage::load("images/logo_bri_black.png", false);
                        $printer->bitImage($logo);
                        $printer->feed(1);

                        /* HEADER */
                        $printer->setJustification(Printer::JUSTIFY_CENTER);
                        $printer->setTextSize(1, 2);
                        $printer->setUnderline(2);
                        $printer->text("Selamat datang!");
                        $printer->feed(2);
                        $printer->setUnderline(0);
                        $printer->setTextSize(1, 1);
                        $printer->text($date);
                        $printer->feed(2);

                        // BODY
                        $printer->setTextSize(6, 6);
                        $printer->setUnderline(0);
                        $printer->text($unitNextNumber);
                        $printer->feed(2);
                        $printer->setTextSize(1, 1);
                        $printer->feed();
                        $printer->text("Terima kasih atas kedatangan anda.\n");
                        $printer->feed(4);
                        $printer->text("");
                        // END BODY

                        $printer->cut();
                        $printer->close();
                    } catch (Exception $e) {
                        $response = [
                            'message' =>  "Couldn't print to this printer: " . $e->getMessage() . "\n",
                            'error' => false,
                        ];
                        $code = 422;
                    }
                } else {
                    $response = [
                        'message' => 'Gagal membuat antrian!',
                        'error' => true,
                    ];
                    $code = 422;
                }
            } else {
                $response = [
                    'message' => 'Unit service not found!',
                    'error' => true,
                ];
                $code = 404;
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
        return view('kios.index');
    }

    public function menuTeller()
    {
        return view('kios.teller', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', '01')->get(),
        ]);
    }

    public function menuCs()
    {
        return view('kios.cs', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', '02')->get(),
        ]);
    }
}
