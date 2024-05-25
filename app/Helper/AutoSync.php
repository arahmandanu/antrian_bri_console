<?php

namespace App\Helper;

use App\Models\OriginCustomer;
use App\Models\Properties;
use Illuminate\Support\Facades\Http;

trait AutoSync
{
    public function execSyncOfflineToOnline(Properties $properties, OriginCustomer $record, $currentTime)
    {
        $url = env('ONLINE_APP_URL', '');
        if (empty($url) || empty($properties->company_code)) return;

        $formatedTime = $currentTime->format('Y-m-d H:i:s');
        $data = $record->toArray();
        $data['current_time'] = $formatedTime;
        $data['company_id'] = $properties->company_code;

        $url2  = $url . '/api/sync_from_local';
        try {
            Http::timeout(3)
                ->connectTimeout(3)
                ->accept('application/json')
                ->post($url2, $data);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return true;
    }

    public function generateNumberQueueOnlineOffline(Properties $properties, $trx_param, $unitService, $currentTime)
    {
        $url = env('ONLINE_APP_URL', '');
        $nextNumber = null;
        $success = false;

        if (empty($url) || empty($properties->company_code)) {
        } else {
            $formatedTime = $currentTime->format('Y-m-d H:i:s');
            $data = [
                'company_id' => $properties->company_code,
                'transaction_params_id' => $trx_param,
                'unitCode' => $unitService,
                'currentTime' => $formatedTime
            ];

            $url2  = $url . '/api/get_number_queue';
            try {
                $response = Http::timeout(3)
                    ->connectTimeout(3)
                    ->accept('application/json')
                    ->post($url2, $data);

                if ($response->successful()) {
                    $nextNumber = $response->collect()->first();
                    $success = true;
                } else {
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        return [$success, $nextNumber];
    }
}
