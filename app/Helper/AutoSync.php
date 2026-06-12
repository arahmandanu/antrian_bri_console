<?php

namespace App\Helper;

use App\Models\Currency;
use App\Models\MasterProduct;
use App\Models\OriginCustomer;
use App\Models\ProductDetail;
use App\Models\Properties;
use App\Models\TransactionCustomer;
use getID3;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

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
                            $url = $value['url_flag'];
                            $destination_folder = public_path('flag');
                            if (!file_exists($destination_folder)) {
                                mkdir($destination_folder, 0777, true);
                            }
                            $newfname = $destination_folder . "/" . $value['url']; //set your file ext
                            $file = fopen($url, "rb");
                            $newf = null;
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
                            if ($currency->show) {
                                $currency->update($record);
                            }
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

    public function syncProductFromServer()
    {
        $onlineApp = config('site.onlineApp');
        $url = config('site.urlOnlineApp');
        $success = false;
        $status = 201;
        if (empty($url) || !$onlineApp) {
            return [$success, "Auto Sync is disabled!"];
        }
        $url2 = $url . "/api/product/detail";
        $response = Http::get($url2);
        try {
            $response = Http::connectTimeout(1)
                ->timeout(3)
                ->accept('application/json')
                ->get($url2);
            $status = $response->status();

            if ($response->successful()) {
                $success = true;
                $message = 'Success sync product';
                if (!empty($response->collect('data'))) {
                    $used = $response->collect('data')->pluck('name');

                    // REMOVE OTHER
                    MasterProduct::whereNotIn('name', $used)->delete();
                    $tes = [];
                    foreach ($response->collect('data') as $value) {
                        if ($product = MasterProduct::where('name', $value['name'])->first()) {
                            if ($product->display_number != $value['display_number']) {
                                $product->update(
                                    [
                                        'display_number' => $value['display_number'],
                                        'show' => true,
                                    ]
                                );
                            }
                        } else {
                            $newProduct = Arr::except($value, ['data']);
                            $product = MasterProduct::create($newProduct);
                        }

                        $productDetails = $value['data'];

                        foreach ($productDetails as $key => $productDetail) {
                            $local = ProductDetail::where('master_product_id', $product->id)->where('display_number', $key + 1)->first();
                            if ($local) {
                                $local->update([
                                    'value' => $productDetail['value'],
                                    'suku_bunga' => $productDetail['suku_bunga'],

                                ]);
                            } else {
                                ProductDetail::create([
                                    'value' => $productDetail['value'],
                                    'suku_bunga' => $productDetail['suku_bunga'],
                                    'master_product_id' => $product->id,
                                    'display_number' => $productDetail['display_number'],
                                ]);
                            }
                        }
                    }
                }
            } else {
                $success = false;
                $message = 'Fail sync product';
            }
        } catch (\Throwable $th) {
            $success = false;
            $message = $th->getMessage();
        }

        return [$success, $message, $status];
    }

    public function getListVideos()
    {
        $onlineApp = config('site.onlineApp');
        $url = config('site.urlOnlineApp');
        $company_type = config('site.company_type') ?? 'all';
        $success = false;

        if (empty($url) || !$onlineApp) {
            return [$success, "Auto Sync is disabled!"];
        }

        $url2 = $url . "/api/video_adds";
        try {
            $response = Http::connectTimeout(1)
                ->timeout(3)
                ->accept('application/json')
                ->withUrlParameters(['company_type' => $company_type])
                ->get($url2 . "?type={$company_type}");

            $status = $response->status();
            if ($response->successful()) {
                $success = true;
                $message = 'Success sync videos';
                $body = $response->collect('data');
            } else {
                $success = false;
                $message = 'Fail sync videos';
            }
        } catch (\Throwable $th) {
            $success = false;
            $message = $th->getMessage();
            $status = $th->getCode();
        }

        return [$success, $message, $status, $body ?? null];
    }

    public function videoDownload($video, $destination_folder)
    {
        $canCreate = false;
        $newFolder = true;
        if (!is_dir(public_path($destination_folder))) {
            if (mkdir(public_path($destination_folder), 0777, true)) {
                $canCreate = true;
            } else {
                $message = "❌ Gagal membuat direktori '{public_path($destination_folder)}'. Periksa izin folder induk.";
            }
        } else {
            $canCreate = true;
            $newFolder = false;
        }

        if ($canCreate) {
            // 1. Opsi Penanganan untuk File Besar
            // Tingkatkan batas waktu eksekusi skrip (misal: 5 menit)
            set_time_limit(300);
            // Tingkatkan batas memori jika diperlukan (walaupun cURL efisien, ini adalah fallback)
            ini_set('memory_limit', '512M');

            // 2. Definisi Path
            $remote_url = $video['path_url'];
            $local_file_name = $video['title']; // Nama file lokal yang Anda inginkan
            $local_path = public_path($destination_folder) . $local_file_name; // Simpan di folder yang sama dengan script ini

            // 3. Persiapan: Buka File Lokal untuk Penulisan
            // File handle akan menjadi target output cURL
            $file_handle = fopen($local_path, 'w');
            $success = false;
            if ($file_handle === false) {
                $message = "❌ Gagal membuka file lokal untuk penulisan: " . $local_path;
            }

            // 4. Inisialisasi dan Konfigurasi cURL
            $ch = curl_init($remote_url);

            // cURL Options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Pastikan response dikirimkan ke stream, bukan dikembalikan
            curl_setopt($ch, CURLOPT_HEADER, 0); // Jangan sertakan header dalam output file
            curl_setopt($ch, CURLOPT_FILE, $file_handle); // *** KUNCI: Arahkan output cURL ke file handle yang sudah dibuka ***

            // Tambahkan User-Agent untuk mengatasi blokir (terutama jika file_get_contents gagal)
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

            // 5. Eksekusi dan Cek Error
            $success = curl_exec($ch);

            if ($success === false) {
                $message = "❌ Error cURL saat mengunduh: " . curl_error($ch);
            } else {
                // Cek kode status HTTP (untuk memastikan file benar-benar ada)
                $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($http_code != 200) {
                    $message = "❌ Gagal: URL mengembalikan kode status HTTP " . $http_code . " (bukan 200 OK).";
                } else {
                    $message = "✅ Berhasil! File video telah diunduh dan disimpan di: " . $local_file_name;
                    $success = true;

                    $getID3 = new getID3();
                    $file_info = $getID3->analyze($local_path);
                    // 1. Cek apakah ada error dari getID3
                    if (isset($file_info['error'])) {
                        if (file_exists($local_path)) {
                            unlink($local_path); // Hapus file yang rusak
                        }
                        $message = 'Error analyzing file: ' . implode(', ', $file_info['error']);
                        $success = false;
                    }

                    // 2. Cek apakah format file video dikenali
                    if (!isset($file_info['video'])) {
                        if (file_exists($local_path)) {
                            unlink($local_path); // Hapus file yang rusak
                        }
                        $message = 'Error analyzing file: type not recognized as video.';
                        $success = false;
                    }

                    // 3. Cek apakah durasi dan ukuran file terdeteksi
                    // File yang rusak seringkali gagal mendeteksi durasi atau ukuran
                    if (
                        !isset($file_info['filesize']) ||
                        !isset($file_info['playtime_seconds']) ||
                        $file_info['playtime_seconds'] < 1 // Durasi minimal 1 detik
                    ) {
                        if (file_exists($local_path)) {
                            unlink($local_path); // Hapus file yang rusak
                        }
                        $message = 'Error analyzing file: length or filesize not detected properly.';
                        $success = false;
                    }

                    if ($success) {
                        if (!$newFolder) {
                            try {
                                // Hapus file lain di folder kecuali file yang baru diunduh
                                $entries = scandir(public_path($destination_folder));
                                $listFile = array_diff($entries, array('.', '..'));
                                foreach ($listFile as $value) {
                                    if ($value != $local_file_name) {
                                        unlink(public_path($destination_folder . $value));
                                    }
                                }
                            } catch (\Throwable $th) {
                                //throw $th;
                            }
                        }
                    }
                }
            }

            // 6. Penutupan
            curl_close($ch);
            fclose($file_handle);
        }
        return [$success ?? false, $message];
    }
}
