<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\TempCallWeb;
use App\Services\SoundCallService;
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
            'message' => 'request tidak sesuai',
        ];
        $playSound = false;
        if ($request->input('id') || $request->input('type')) {
            $buttonActor = ButtonActor::where('user_button_code', '=', $request->input('id'))->first();
            if (Str::lower($request->input('type')) == 'call' && $buttonActor) {
                $codeservice = $buttonActor->codeService;
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
                        $this->createAntrian($listQueue, $buttonActor, $codeservice);
                        $currentCall = $listQueue->SeqNumber;
                        $playSound = true;
                    }
                }
            } elseif (Str::lower($request->input('type')) == 'recall' && $buttonActor) {
                $codeservice = $buttonActor->codeService;
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

    private function createAntrian(OriginCustomer $originCustomer, ButtonActor $buttonActor, Codeservice $codeservice)
    {
        $currentTime = now();
        $createdTicket = $originCustomer->created_at;

        TempCallWeb::create([
            'Counter' => $buttonActor->counter_number,
            'Unit' => $codeservice->Initial,
            'SeqNumber' => $originCustomer->SeqNumber,
        ]);

        $buttonActor->update([
            'last_queue_number' => $originCustomer->SeqNumber,
            'last_queue_called' => now(),
            'originationcust_SeqDt' => $originCustomer->SeqDt
        ]);

        $lastqueueNumber = $codeservice->last_queue;
        $codeservice->update([
            'last_queue' => $lastqueueNumber + 1,
        ]);

        $originCustomer->update([
            'TimeCall' => $currentTime->format('H:i:s'),
            'Flag' => 'N',
            'WaitDuration' => gmdate('H:i:s', $currentTime->diffInSeconds($createdTicket)),
        ]);
    }
}
