<?php

namespace App\Http\Controllers;

use App\Models\Codeservice;
use App\Models\Properties;
use App\Models\TempCallWeb;

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
        $queue = TempCallWeb::listNewest()->take(1)->get()->first();
        if ($queue) {
            if ($queue->Tampil == 'n') {
                $data = $queue;
                $queue->update(['Tampil' => 'y']);

                $codeService = Codeservice::where('Initial', '=', $queue->Unit)->first();
                $number = substr($data->SeqNumber, 1, 3);
                $codeService->last_queue = $number;
                $codeService->save();
            }
        }

        return response()->json([
            'queue' => $data,
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
