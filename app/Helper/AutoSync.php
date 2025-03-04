<?php

namespace App\Helper;

use App\Models\Currency;
use App\Models\OriginCustomer;
use App\Models\Properties;
use App\Models\TransactionCustomer;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait AutoSync
{
    public function execSyncOfflineToOnline(Properties $properties, OriginCustomer $record, $currentTime)
    {
        $onlineApp = config('site.onlineApp');
        $url = config('site.urlOnlineApp');
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
        $onlineApp = config('site.onlineApp');
        $url = config('site.urlOnlineApp');
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
        $url = config('site.urlOnlineApp');
        $onlineApp = config('site.onlineApp');
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

    public function syncCurrencyFromServer()
    {
        $onlineApp = config('site.onlineApp');
        $url = config('site.urlOnlineApp');
        $success = false;
        if (empty($url) || !$onlineApp) {
            return [$success, "Auto Sync is disabled!"];
        }
        $url2 = $url . "/api/currencies/list";
        $response = Http::get($url2);
        try {
            $response = Http::connectTimeout(1)
                ->timeout(3)
                ->accept('application/json')
                ->get($url2);

            if ($response->successful()) {
                if (!empty($response->collect('data'))) {
                    foreach ($response->collect('data') as $key => $value) {


                        $record = [];
                        $record['name'] = $value['name'];
                        $record['jual_a'] = $value['jual'];
                        $record['beli_a'] = $value['beli'];
                        $record['jual_b'] = "0";
                        $record['beli_b'] = "0";
                        $record['show'] = true;

                        $existFile = public_path("flag/{$value['url']}");
                        if (!file_exists($existFile)) {
                            dd($existFile);
                            $url = $value['url_flag'];
                            $destination_folder = public_path('flag');
                            $newfname = $destination_folder . "/" . $value['url']; //set your file ext
                            $file = fopen($url, "rb");
                            if ($file) {
                                $newf = fopen($newfname, "a"); // to overwrite existing file
                                if ($newf)
                                    while (!feof($file)) {
                                        fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                                    }
                            }
                            if ($file) {
                                fclose($file);
                            }
                            if ($newf) {
                                fclose($newf);
                            }
                        }

                        $record['flag_url'] = "flag/{$value['url']}";
                        if ($currency = Currency::where('name', $value['name'])->first()) {
                            $currency->update($record);
                        } else {
                            Currency::create($record);
                        }
                    }
                }
            } else {
            }
        } catch (\Throwable $th) {
            // throw $th;
        }
    }
}
