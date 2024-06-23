<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\TempCallWeb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Queue extends Controller
{

    public function getNextQueue(Request $request)
    {
        $status = 422;
        $data = [
            'error' => true,
            'message' => 'request tidak sesuai'
        ];

        if ($request->input('id') || $request->input('type')) {
            $buttonActor = ButtonActor::where('user_button_code', '=', $request->input('id'))->first();
            if (Str::lower($request->input('type')) == 'call' && $buttonActor) {
                $codeservice = $buttonActor->codeService;
                $currentCall = $buttonActor->last_queue_number;
                // check ada antrian tidak?
                if ($codeservice->haveQueue() === true) {
                    $listQueue = OriginCustomer::where('UnitServe', '=', $buttonActor->unit_service)->Call()->limit(1)->get()->first();
                    // dd($listQueue);
                    #ada antrian dipanggil
                    if ($listQueue) {
                        $this->createAntrian($listQueue, $buttonActor, $codeservice);
                        $currentCall = $listQueue->SeqNumber;
                    }
                }
            } else if (Str::lower($request->input('type')) == 'recall' && $buttonActor) {
                $codeservice = $buttonActor->codeService;
                $currentCall = $buttonActor->last_queue_number;

                $listQueue = OriginCustomer
                    ::where('UnitServe', '=', $buttonActor->unit_service)
                    ->where('SeqNumber', '=', $currentCall)
                    ->first();

                TempCallWeb::create([
                    'Counter' => $buttonActor->counter_number,
                    'Unit' => $codeservice->Initial,
                    'SeqNumber' => $listQueue->SeqNumber
                ]);
            }

            $status = 200;
            $data = [
                'nama' => $buttonActor->name,
                'total_antrian' => $codeservice->CurrentQNo,
                'sisa_antrian' => $codeservice->sisaAntrian(),
                'current_call_antrian' => $currentCall
            ];
        }

        return response($data, $status);
    }

    private function createAntrian(OriginCustomer $originCustomer, ButtonActor $buttonActor, Codeservice $codeservice)
    {
        TempCallWeb::create([
            'Counter' => $buttonActor->counter_number,
            'Unit' => $codeservice->Initial,
            'SeqNumber' => $originCustomer->SeqNumber
        ]);

        $buttonActor->update([
            'last_queue_number' => $originCustomer->SeqNumber,
            'last_queue_called' => now(),
        ]);

        $lastqueueNumber = $codeservice->last_queue;
        $codeservice->update([
            'last_queue' => $lastqueueNumber + 1
        ]);

        $currentTime = now();
        $createdTicket = $originCustomer->created_at;
        // with query Builder
        $data = DB::table('originationcust')
            ->where('UnitServe', $buttonActor->unit_service)
            ->where('SeqNumber', $originCustomer->SeqNumber)
            ->limit(1)
            ->update([
                'TimeCall' => gmdate('H:i:s', $currentTime->diffInSeconds($createdTicket)),
                'Flag' => 'N',
                'WaitDuration' => '00:00:00'
            ]);
        return;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
