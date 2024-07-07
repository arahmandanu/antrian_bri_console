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
        $dirIklan = public_path('/iklan_kios');
        if (!is_dir($dirIklan)) {
            mkdir($dirIklan, 0777, true);
        }

        $listKios = scandir($dirIklan);
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

        $companyName = $properties->company_name ?? '';
        $footerFlow = $properties ? $properties->footer_flow_kios ?? 'left' : 'left';
        $fotrColor = $footerColorRecord ? $footerColorRecord->value ?? 'white' : 'white';

        return view('kios.shared.main', [
            'listGambar' => $gambar,
            'footerTexts' => $footerTexts,
            'footer_flow' => $footerFlow,
            'fotrColor' => $fotrColor,
            'companyName' => $companyName,
        ]);
    }

    public function printOnlineQueue(Request $request)
    {
        if (empty($barcode = $request->input('data'))) {
            return response()->json([
                'message' => 'Failed request!',
                'error' => true,
            ], 405);
        }

        $date = substr($barcode, 0, 8);
        $companyId = substr($barcode, 8, 5);
        $unitService = substr($barcode, 13, 1);
        $antrian = substr($barcode, 14, 3);
        $barcodeUnit = substr($barcode, 17, 4);

        if ((int) $antrian == 0) {
            return response()->json([
                'message' => 'Nomor antrian tidak valid, silahkan ambil nomor antrian baru!',
                'error' => true,
            ], 422);
        }

        $currentTime = now();
        $properties = Properties::first();

        if (empty($properties) || $properties->company_code != $companyId) {
            return response()->json([
                'message' => 'Cabang unit tidak sesuai, silahkan ambil antrian baru!',
                'error' => true,
            ], 422);
        }

        // validate Date or online to local company
        if ($currentTime->format('dmY') !== $date) {
            return response()->json([
                'message' => 'Tanggal antrian sudah terlewati atau tidak sesuai, silahkan ambil antrian baru!',
                'error' => true,
            ], 422);
        }

        // check apakah antrian masih bisa di panggil
        $exist = OriginCustomer::where('BaseDt', '=', $currentTime->format('Ymd'))
            ->where('SeqNumber', '=', "$unitService$antrian")
            ->where('UnitServe', '=', $unitService)
            ->first();

        $codeService = Codeservice::where('Initial', '=', $unitService)->first();
        $lastCall = $codeService->last_queue;
        $validNumber = ((int) $antrian > $lastCall);

        if ($exist || !$validNumber) {
            return response()->json([
                'message' => 'Nomor antrian sudah expired, silahkan ambil nomor antrian baru!',
                'error' => true,
            ], 422);
        }

        if (empty($barcodeUnit)) {
            $trxParam = TransactionParam::where('UnitService', '=', $unitService)->first() ?? TransactionParam::where('TrxCode', '=', $barcodeUnit)->first();
            if (empty($trxParam)) {
                $trxParamCode = $barcodeUnit;
                $trxParamService = '00:00:00';
            } else {
                $trxParamCode = $trxParam->TrxCode;
                $trxParamService = $trxParam->Tservice ?? '00:00:00';
            }
        }

        $currentTime = now();
        $descTransaction = 'Antrian ' . $codeService->Name;
        $params = [
            'BaseDt' => $currentTime->isoFormat('OYMMDD'),
            'SeqNumber' => $unitService . $antrian,
            'UnitServe' => $unitService,
            'TimeTicket' => $currentTime->isoFormat('HH:mm:ss'),
            'TimeCall' => null,
            'WaitDuration' => null,
            'Flag' => 'P',
            'origin_queue_number' => (int) $antrian,
            'DescTransaksi' => $descTransaction,
            'UnitCall' => $unitService,
            'code_trx' => $trxParamCode,
            'SLA_Trx' => $trxParamService,
            'is_queue_online' => true,
        ];
        $codeService->CurrentQNo = (int) $antrian;
        $updateCodeService = $codeService->save();
        if (!OriginCustomer::create($params) && !$updateCodeService) {
            return response()->json([
                'message' => 'Gagal membuat antrian!',
                'error' => true,
            ], 503);
        }

        try {
            $this->execPrint($currentTime, $descTransaction, $unitService . $antrian, $properties);
            $response = [
                'message' => 'Sukses membuat antrian!',
                'error' => false,
            ];
            $code = 201;
        } catch (\Throwable $th) {
            $response = [
                'message' => 'Printer belum siap digunakan!',
                'error' => true,
            ];
            $code = 422;
        }

        return response()->json($response, $code);
    }

    public function createAntrian(Request $request)
    {
        Validator::make($request->all(), [
            'trx_param' => 'required|exists:trxparam,TrxCode',
            'unit_service' => 'required|in:A,B',
        ])->validate();

        if (empty($properties = Properties::first())) {
            return response()->json([
                'message' => 'Pastikan printer siap digunakan!',
                'error' => true,
            ], 503);
        }

        if (env('PRINTER_ENABLED', true) && $properties->printer_name == null) {
            return response()->json([
                'message' => 'Pastikan printer siap digunakan!',
                'error' => true,
            ], 503);
        }

        if (empty($currentQue = Codeservice::where('Initial', '=', $request['unit_service'])->first())) {
            return response()->json([
                'message' => 'Unit service not found!',
                'error' => true,
            ], 404);
        }

        $trxParam = TransactionParam::where('TrxCode', '=', $request['trx_param'])->first();
        $currentTime = now();
        // Use Online First
        $responseFromServer = $this->generateNumberQueueOnlineOffline($properties, $request->trx_param, $request->unit_service, $currentTime, $currentQue->last_queue);
        if ($responseFromServer[0] == true) {
            // Todo adjust to get pure queue number
            $nextNumber = $responseFromServer[1];
            $myQueue = $responseFromServer[1];
        } else {
            $nextNumber = $currentQue->CurrentQNo + 1;
            $myQueue = self::formatQueue($nextNumber);
        }

        $unitNextNumber = $request['unit_service'] . $myQueue;
        $descTransaction = 'Antrian ' . $currentQue->Name;
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
            'is_queue_online' => false,
        ];
        $currentQue->CurrentQNo = $nextNumber;
        $updateCodeService = $currentQue->save();
        if (!($recordQueue = OriginCustomer::create($params)) && !$updateCodeService) {
            return response()->json([
                'message' => 'Gagal membuat antrian!',
                'error' => true,
            ], 503);
        }

        try {
            $this->execPrint($currentTime, $descTransaction, $unitNextNumber, $properties);
            $response = [
                'message' => 'Sukses membuat antrian!',
                'error' => false,
            ];
            $code = 201;
        } catch (\Throwable $th) {
            $response = [
                'message' => 'Printer belum siap digunakan!',
                'error' => true,
            ];
            $code = 422;
        }

        if ($responseFromServer[0] == false) {
            $this->execSyncOfflineToOnline($properties, $recordQueue, $currentTime);
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
