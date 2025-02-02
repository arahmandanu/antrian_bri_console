<?php

namespace App\Http\Controllers;

use App\Enum\CodeServiceEnum;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\Properties;
use App\Models\TempCallWeb;
use App\Services\SoundCallService;

class TempCallWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function nextQueue()
    {
        $data = null;
        $queue = null;
        $marginTime = 0;
        $delay = (int)(env('DELAY_SOUND', 8));
        $haveMargin = false;
        $before = null;
        if ($needToCall = TempCallWeb::notCalled()->listOldest()->first()) {
            if ($lastCalled = TempCallWeb::doneCalled()->listNewest()->first()) {
                if (($needToCall->updated_at->getTimestamp() - $lastCalled->updated_at->getTimestamp()) >= $delay) {
                    $queue = $needToCall;
                    $haveMargin = true;
                } else {
                    $needToCall->touch();
                }
            } else {
                $queue = $needToCall;
            }

            if ($queue) {
                if ($queue->Tampil == 'n') {
                    if ($haveMargin === true) {
                        if (($queue->updated_at->getTimestamp() - $lastCalled->updated_at->getTimestamp()) >= $delay) {
                            $before = $lastCalled;
                            $marginTime =  $queue->updated_at->getTimestamp() - $lastCalled->updated_at->getTimestamp();
                            $data = $queue;
                            $queue->Tampil = 'y';
                            $queue->save();

                            $codeService = Codeservice::where('Initial', '=', $queue->Unit)->first();
                            $number = substr($data->SeqNumber, 1, 3);
                            $codeService->last_queue = $number;
                            $codeService->save();

                            $buttonActor = ButtonActor::find($queue->button_actor_id);
                            $callQeueue = OriginCustomer::where('SeqNumber', '=', $queue->SeqNumber)->first();
                            (new SoundCallService($callQeueue, $buttonActor))->playSound();
                        }
                    } else {
                        $data = $queue;
                        $queue->Tampil = 'y';
                        $queue->save();

                        $codeService = Codeservice::where('Initial', '=', $queue->Unit)->first();
                        $number = substr($data->SeqNumber, 1, 3);
                        $codeService->last_queue = $number;
                        $codeService->save();

                        $buttonActor = ButtonActor::find($queue->button_actor_id);
                        $callQeueue = OriginCustomer::where('SeqNumber', '=', $queue->SeqNumber)->first();
                        (new SoundCallService($callQeueue, $buttonActor))->playSound();
                    }
                }
            }
        }

        return response()->json([
            'queue' => $data,
            'before' => $before,
            'margin_time' => $marginTime,
            'settings' => $delay
        ], 200);
    }

    public function reportQueue()
    {
        $properties = Properties::first();
        if (empty($properties)) {
            $code = 422;
            $message = 'System is not ready';
            $success = false;
        } else {
            $response = $this->syncReportToServer($properties);
            $success = $response[0];
            $message = $response[1];
            $code = $response[2];
        }

        return response()->json([
            'message' => $message,
            'success' => $success,
        ], $code);
    }
}
