<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use Illuminate\Http\Request;

class ButtonActorController extends Controller
{
    public function syncButtonActor(Request $request)
    {
        $status = 422;
        $data = [
            'error' => true,
            'message' => 'request tidak sesuai, pastikan button actor ada!',
        ];

        if ($request->input('id') && ($buttonActor = ButtonActor::where('user_button_code', '=', $request->input('id'))->first())) {
            $codeservice = $buttonActor->codeService;
            $currentCall = $buttonActor->last_queue_number;
            $status = 200;
            $data = [
                'nama' => $buttonActor->name,
                'total_antrian' => $codeservice->CurrentQNo,
                'sisa_antrian' => $codeservice->sisaAntrian(),
                'current_call_antrian' => $currentCall,
                'konter' => $buttonActor->counter_number
            ];
        }

        return response($data, $status);
    }
}
