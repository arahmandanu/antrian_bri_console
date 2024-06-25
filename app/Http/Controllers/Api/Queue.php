<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\TempCallWeb;
use App\Models\TransactionCustomer;
use App\Services\SoundCallService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Queue extends Controller
{
    public function getNextQueue(Request $request)
    {
        $status = 422;
        $data = [
            'error' => true,
            'message' => 'request tidak sesuai, pastikan button actor ada!',
        ];

        $currentTime = now();
        $playSound = false;
        if ($request->input('id') && $request->input('type') && $buttonActor = ButtonActor::where('user_button_code', '=', $request->input('id'))->first()) {
            $codeservice = $buttonActor->codeService;

            if (Str::lower($request->input('type')) == 'call' && $buttonActor) {
                $currentCall = $buttonActor->last_queue_number;
                // check ada antrian tidak?
                if ($codeservice->haveQueue() === true) {
                    $listQueue = OriginCustomer::where('UnitServe', '=', $buttonActor->unit_service)
                        ->Call()
                        ->limit(1)
                        ->get()
                        ->first();

                    //ada antrian dipanggil
                    if ($listQueue) {
                        $this->insertReport($buttonActor, $currentTime);
                        $this->createAntrian($listQueue, $buttonActor, $codeservice, $currentTime);
                        $currentCall = $listQueue->SeqNumber;
                        $playSound = true;
                    }
                } else {
                    $this->insertReport($buttonActor, $currentTime);
                }
            } elseif (Str::lower($request->input('type')) == 'recall' && $buttonActor) {
                $currentCall = $buttonActor->last_queue_number;

                $listQueue = OriginCustomer::where('UnitServe', '=', $buttonActor->unit_service)
                    ->where('SeqNumber', '=', $currentCall)
                    ->limit(1)
                    ->first();

                TempCallWeb::create([
                    'Counter' => $buttonActor->counter_number,
                    'Unit' => $codeservice->Initial,
                    'SeqNumber' => $listQueue->SeqNumber,
                ]);
                $playSound = true;
            }

            $status = 200;
            $data = [
                'nama' => $buttonActor->name,
                'total_antrian' => $codeservice->CurrentQNo,
                'sisa_antrian' => $codeservice->sisaAntrian(),
                'current_call_antrian' => $currentCall,
            ];

            if ($playSound) {
                (new SoundCallService($listQueue, $buttonActor))->playSound();
            }
        }

        return response($data, $status);
    }

    private function createAntrian(OriginCustomer $originCustomer, ButtonActor $buttonActor, Codeservice $codeservice, $currentTime)
    {
        $createdTicket = $originCustomer->created_at;

        // Tampilan web antrian
        TempCallWeb::create([
            'Counter' => $buttonActor->counter_number,
            'Unit' => $codeservice->Initial,
            'SeqNumber' => $originCustomer->SeqNumber,
        ]);

        // button actor dapat antrian terbaru
        $buttonActor->update([
            'last_queue_number' => $originCustomer->SeqNumber,
            'last_queue_called' => now(),
            'originationcust_SeqDt' => $originCustomer->SeqDt,
        ]);

        // code service di edit antriannya
        // to handle when have queue from online
        $params = [
            'last_queue' => $originCustomer->origin_queue_number,
        ];
        if ($codeservice->CurrentQNo < $originCustomer->origin_queue_number) {
            $params['CurrentQNo'] = $originCustomer->origin_queue_number;
        }
        $codeservice->update($params);

        // set sebagai terpanggil antrian
        $originCustomer->update([
            'TimeCall' => $currentTime->format('H:i:s'),
            'Flag' => 'N',
            'WaitDuration' => gmdate('H:i:s', $currentTime->diffInSeconds($createdTicket)),
        ]);
    }

    private function insertReport(ButtonActor $buttonActor, $currentTime)
    {
        if (empty($buttonActor->originationcust_SeqDt)) {
            return;
        }

        // check first karena gak ada relasi
        $exist = TransactionCustomer::where('BaseDt', $currentTime->format('Ymd'))
            ->where('SeqNumber', $buttonActor->last_queue_number)
            ->count();

        if ($exist > 0) return;

        $oldQueue = $buttonActor->lastOriginCustomer;
        $timeCall = Carbon::createFromFormat('H:i:s', $oldQueue->TimeCall);
        $timeService = gmdate('H:i:s', $timeCall->diffInSeconds($currentTime));
        $timeOverSla = '00:00:00';
        if ($oldQueue->transactionParam->Tservice != '00:00:00') {
            // mainkan secondnya selalu force beginning date
            $startDate = $currentTime->copy()->startOfDay();
            $slaTime = Carbon::createFromFormat('H:i:s', $oldQueue->transactionParam->Tservice);
            $expectedSla = $timeCall->copy()->addSeconds($startDate->diffInSeconds($slaTime));

            if ($currentTime >= $expectedSla) {
                $timeOverSla = gmdate('H:i:s', $currentTime->diffInSeconds($expectedSla));
            }
        }

        $params = [
            'BaseDt' => $oldQueue->BaseDt,
            'SeqNumber' => $oldQueue->SeqNumber,
            'TrxDesc' => $oldQueue->code_trx,
            'TimeTicket' => $oldQueue->TimeTicket,
            'TimeCall' => $oldQueue->TimeCall,
            'CustWaitDuration' => $oldQueue->WaitDuration,
            'UnitServe' => $oldQueue->UnitServe,
            'CounterNo' => $buttonActor->counter_number,
            'Absent' => 'N',
            'UserId' => $buttonActor->name,
            'Flag' => $oldQueue->Flag,
            'TimeEnd' => $currentTime->format('H:i:s'),
            'Tservice' => $timeService,
            'TWservice' => '00:00:00',
            'TSLAservice' => $oldQueue->transactionParam->Tservice,
            'TOverSLA' => $timeOverSla,
        ];

        TransactionCustomer::create($params);
    }
}
