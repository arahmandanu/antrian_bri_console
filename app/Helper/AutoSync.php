<?php

namespace App\Helper;

use App\Models\OriginCustomer;
use App\Models\Properties;
use App\Models\TransactionCustomer;
use Illuminate\Support\Facades\Http;

trait AutoSync
{
    public function execSyncOfflineToOnline(Properties $properties, OriginCustomer $record, $currentTime)
    {
        $onlineApp = env('ONLINE_APP', false);
        $url = env('ONLINE_APP_URL', '');
        if (empty($url) || empty($properties->company_code) || !$onlineApp) {
            return;
        }

        $formatedTime = $currentTime->format('Y-m-d H:i:s');
        $data = $record->toArray();
        $data['current_time'] = $formatedTime;
        $data['company_id'] = $properties->company_code;

        $url2 = $url . '/api/sync_from_local';
        try {
            Http::connectTimeout(1)
                ->timeout(3)
                ->accept('application/json')
                ->post($url2, $data);
        } catch (\Throwable $th) {
            //throw $th;
        }

        return true;
    }

    public function generateNumberQueueOnlineOffline(Properties $properties, $trx_param, $unitService, $currentTime, $lastQueueNumber)
    {
        $onlineApp = env('ONLINE_APP', false);
        $url = env('ONLINE_APP_URL', '');
        $nextNumber = null;
        $success = false;
        if (empty($url) || empty($properties->company_code) || !$onlineApp) {
            return [$success, $nextNumber];
        }

        $formatedTime = $currentTime->format('Y-m-d H:i:s');
        $data = [
            'company_id' => $properties->company_code,
            'transaction_params_id' => $trx_param,
            'unitCode' => $unitService,
            'currentTime' => $formatedTime,
            'last_queue_number' => $lastQueueNumber
        ];
        $url2 = $url . '/api/get_number_queue';
        try {
            $response = Http::connectTimeout(1)
                ->timeout(3)
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

        return [$success, $nextNumber];
    }

    public function syncReportToServer(Properties $properties)
    {
        $message = 'Synced Disabled!';
        $success = true;
        $status = 200;
        $url = config('site.urlOnlineApp', '');
        $onlineApp = config('site.onlineApp', false);
        if (empty($url) || empty($properties->company_code) || !$onlineApp) return [$success, ['message' => $message, 'url' => $url, 'statusOnline' => $onlineApp], $status];

        $currentTime = now()->format('Ymd');
        $reports = TransactionCustomer::where('BaseDt', '=', $currentTime)->notSynced()->limit(5);
        $result = $reports->get();

        if ($result->count() > 0) {
            $url2 = $url . '/api/sync_report_from_local';
            try {
                $response = Http::connectTimeout(1)
                    ->timeout(3)
                    ->accept('application/json')
                    ->post($url2, ['reports' => $result->toArray(), 'company_id' => $properties->company_code]);

                if ($response->successful()) {
                    $success = true;
                    $message = 'Success sync';
                    $status = 200;
                    $reports->update(['synced' => 'Y']);
                }
            } catch (\Throwable $th) {
                $success = true;
                $message = $th->getMessage();
                $status = 422;
            }
        } else {
            $success = true;
            $message = 'no data to be synced';
            $status = 200;
        }

        return [$success, $message, $status];
    }
}
