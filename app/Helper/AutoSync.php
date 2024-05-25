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
}
