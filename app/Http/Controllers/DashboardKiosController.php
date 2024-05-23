<?php

namespace App\Http\Controllers;

use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\TransactionParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;

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
            $validated = Validator::make($request->all(), [
                'trx_param' => 'required|exists:trxparam,TrxCode',
                'unit_service' => 'required|in:A,B',
            ])->validate();

            $currentQue = Codeservice::where('Initial', '=', $request['unit_service'])->first();
            $trxParam = TransactionParam::where('TrxCode', '=', $request['trx_param'])->first();

            if ($currentQue) {
                $nextNumber = $currentQue->CurrentQNo + 1;
                $myQueue = self::formatQueue($nextNumber);
                $currentTime = now();
                $params = [
                    'BaseDt' => $currentTime->isoFormat('OYMMDD'),
                    'SeqNumber' => ($request['unit_service'] . $myQueue),
                    'UnitServe' => $request['unit_service'],
                    'TimeTicket' => $currentTime->isoFormat('HH:mm:ss'),
                    'Flag' => 'P',
                    'DescTransaksi' => 'Antrian ' . ($request['unit_service'] == 'A' ? 'Teller' : 'CS'),
                    'UnitCall' => $request['unit_service'],
                    'code_trx' =>  $request['trx_param'],
                    'SLA_Trx' =>   $trxParam->Tservice
                ];
                $currentQue->CurrentQNo = $nextNumber;
                if (OriginCustomer::create($params) && $currentQue->save()) {
                    $response = [
                        'message' => 'Sukses membuat antrian!',
                        'error' => false
                    ];
                    $code = 201;
                } else {
                    $response = [
                        'message' => 'Gagal membuat antrian!',
                        'error' => true
                    ];
                    $code = 422;
                }
            } else {
                $response = [
                    'message' => 'Unit service not found!',
                    'error' => true
                ];
                $code = 404;
            }
        } else {
            $response = [
                'message' => 'Failed request!',
                'error' => true
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
            'buttons' => TransactionParam::show()->where('UnitService', '=', '01')->get()
        ]);
    }

    public function menuCs()
    {
        return view('kios.cs', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', '02')->get()
        ]);
    }
}
