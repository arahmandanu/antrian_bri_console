<?php

namespace App\Http\Controllers;

use App\Models\Codeservice;
use App\Models\Currency;
use App\Models\FontColor;
use App\Models\FooterText;
use App\Models\MasterProduct;
use App\Models\Properties;
use App\Models\TempCallWeb;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public const VIDEO_EXTENSION = ['mov', 'mp4', 'flv', 'mpg', 'mpeg', 'mpv'];

    public const IMAGE_EXTENSION = ['jpg', 'jpeg', 'giv', 'png', 'svg', 'webp'];
    public const VIDEO_ONLINE_PATH = 'video_online/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // --- 1. INISIALISASI & KONSTANTA ---
        // Pastikan VIDEO_ONLINE_PATH, VIDEO_EXTENSION, dan IMAGE_EXTENSION adalah konstanta kelas yang benar.
        $dirVideoOnline = public_path($this::VIDEO_ONLINE_PATH);
        $videos = [];
        $videoOnline = false; // Variabel diperbaiki dari $videOnline

        // --- 2. LOGIKA VIDEO ONLINE (Prioritas Utama & Pembersihan) ---
        if (is_dir($dirVideoOnline)) {
            $localVideos = [];
            // Menggunakan File::files() (lebih Laravel-ish) atau scandir()
            // Menggunakan scandir() sesuai permintaan asli
            $listFile = array_diff(scandir($dirVideoOnline), ['.', '..']); // Filter . dan ..

            foreach ($listFile as $value) {
                $extension = pathinfo($value, PATHINFO_EXTENSION);

                if (in_array(strtolower($extension), $this::VIDEO_EXTENSION)) {
                    $full_path = $dirVideoOnline . DIRECTORY_SEPARATOR . $value;

                    // Perlu memastikan filemtime() tidak error (misalnya permission denied)
                    $mtime = file_exists($full_path) ? filemtime($full_path) : 0;

                    $localVideos[] = [
                        'filename' => $value,
                        'path' => $full_path,
                        'mtime' => $mtime,
                    ];
                }
            }

            if (!empty($localVideos)) {
                // Urutkan berdasarkan tanggal modifikasi (mtime) secara menurun (terbaru)
                usort($localVideos, function ($a, $b) {
                    return $b['mtime'] - $a['mtime'];
                });

                // Ambil video terbaru (index 0) dan hapus sisanya
                foreach ($localVideos as $key => $video) {
                    if ($key === 0) {
                        $videos[] = $video['filename']; // Hanya satu video terbaru yang disimpan
                    } else {
                        try {
                            unlink($video['path']);
                        } catch (\Exception $e) {
                            // Log kesalahan jika unlink gagal (PENTING untuk debugging permission)
                            // \Log::warning("Gagal menghapus file lama: " . $video['path'] . " Error: " . $e->getMessage());
                        }
                    }
                }

                // Set flag hanya jika ada video yang disimpan
                if (!empty($videos)) {
                    $videoOnline = true;
                }
            }
        }

        // --- 3. LOGIKA VIDEO DEFAULT (Jika Video Online Kosong) ---
        if (empty($videos)) {
            $defaultDir = public_path('video');
            $listFile = is_dir($defaultDir) ? array_diff(scandir($defaultDir), ['.', '..']) : [];

            foreach ($listFile as $value) {
                $extension = pathinfo($value, PATHINFO_EXTENSION);
                if (in_array(strtolower($extension), $this::VIDEO_EXTENSION)) {
                    $videos[] = $value;
                }
            }
        }

        // --- 4. LOGIKA GAMBAR (Iklan) ---
        $imageDir = public_path('iklan_image');
        $listImages = is_dir($imageDir) ? array_diff(scandir($imageDir), ['.', '..']) : [];
        $images = [];

        foreach ($listImages as $value) {
            $extension = pathinfo($value, PATHINFO_EXTENSION);
            if (in_array(strtolower($extension), $this::IMAGE_EXTENSION)) {
                $images[] = $value;
            }
        }

        // --- 5. LOGIKA DATA PROPERTI & PRODUK/MATA UANG ---
        $properties = Properties::first();
        $data = []; // Gunakan array $data untuk menampung semua data view

        // Menghindari error jika $properties null (jika tidak ada data di database)
        $showProduct = $properties->show_product ?? true;
        $showCurrency = $properties->show_currency ?? true;

        // Logika Produk
        $products = ($showProduct || !$properties) ? MasterProduct::Show()->get() : collect();
        if ($products){
            $data['products'] =  $products
            ->groupBy(fn($item) => $item->created_at->format('Y-m-d'))
            ->sortKeysDesc()
            ->first();
        }
        // Logika Mata Uang
        $data['currencies'] = ($showCurrency || !$properties) ? Currency::show()->get() : collect();

        // --- 6. LOGIKA DATA ANTREAN ---
        // Menggunakan listNewest() dari TempCallWeb
        $listQueues = TempCallWeb::doneCalled()->listNewest()->take(3)->get();
        $datalistQueues = [];
        foreach ($listQueues as $key => $queue) {
            array_push($datalistQueues, $queue);
        }
        // Langsung menggunakan collection/array dari model
        $data['historyQueues'] = $datalistQueues;

        // --- 7. FINAL DATA ASIGNMENT ---
        $data['show_product'] = $showProduct;
        $data['show_currency'] = $showCurrency;
        $data['show_both'] = $showProduct && $showCurrency;
        $data['list_footer_text'] = FooterText::show()->get();

        // Menggunakan null coalescing untuk nilai default
        $data['footer_flow'] = $properties->footer_flow ?? 'right';
        $data['videos'] = $videos;
        $data['video_online'] = $videoOnline;
        $data['images'] = $images;
        $data['company_name'] = $properties->company_name ?? null;

        // Tambahkan data warna (lebih ringkas menggunakan collect)
        FontColor::where('value', '!=', null)->get()->each(function ($value) use (&$data) {
            $data[$value->name] = $value->value;
        });

        // --- 8. RETURN VIEW ---
        return view('shared.main', $data);
    }

    public function refreshCounter(Request $request)
    {
        abort_if(!$request->wantsJson(), 403, 'Invalid request!');

        $codeServices = Codeservice::all();
        foreach ($codeServices as $key => $value) {
            $value->CurrentQNo = $value->last_queue;
            $value->is_reset_counter = true;
            $value->save();
        }

        return response()->json(['message' => 'succes reset'], 200);
    }

    public function videosList(Request $request)
    {
        abort_if(!$request->wantsJson(), 403, 'Invalid request!');

        $listFile = scandir(public_path('/video'));
        $videos = [];
        foreach ($listFile as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::VIDEO_EXTENSION)) {
                array_push($videos, $value);
            }
        }

        return response()->json([
            'videos' => $videos,
        ], 200);
    }

    public function consoleApp(Request $request)
    {
        $task_list = [];
        exec('start /B tasklist /nh /fi "ImageName eq Console.exe"', $task_list);
        $message = null;
        $enabler = true;
        foreach ($task_list as $key => $value) {
            if ($value !== '') {
                if (str_contains($value, 'Console.exe')) {
                    $enabler = false;
                    $message = 'Console sudah aktif sebelumnya!';
                }
            }
        }

        if ($enabler == true) {
            $path = base_path('call_console.php');
            // exec("php $path", $test);
            pclose(popen('start /B cmd /C "php ' . $path . ' >NUL 2>NUL"', 'r'));
            $message = 'Console berhasil di jalankan!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    public function syncVideos(Request $request)
    {
        $status = 200;
        [$success, $message, $status, $body] = $this->getListVideos();
        if ($success && $status == 200) {
            $data = json_decode($body, true);
            if (!empty($data)) {
                $data = $data[0];
                if (file_exists(public_path($this::VIDEO_ONLINE_PATH . $data['title']))) {
                    $message = 'Video iklan online sudah ada sebelumnya!';
                } else {
                    [$success, $message] = $this->videoDownload($data, $this::VIDEO_ONLINE_PATH);
                    if ($success) {
                        $message = 'Sinkronisasi video iklan online berhasil!';
                    } else {
                        $status = 422;
                    }
                }
            }
        }

        return response()->json([
            'success' => $status == 200,
            'message' => $message,
            'status' => $status,
        ], $status);
    }

    public function closeConsole(Request $request)
    {
        $task_list = [];
        // exec('start /B tasklist /nh /fi "ImageName eq Console.exe"', $task_list);
        exec('start /B taskkill /IM firefox.exe /F', $task_list);
        exec('start /B taskkill /IM msedge.exe /F', $task_list);
        exec('start /B taskkill /IM chrome.exe /F', $task_list);
        $message = null;
        $alreadyRun = false;
        $data = [];
        foreach ($task_list as $key => $value) {
            if ($value !== '') {
                if (str_contains($value, 'Console.exe')) {
                    $alreadyRun = true;
                    array_push($data, $value);
                    $message = 'Console tidak aktif sebelumnya!';
                }
            }
        }

        if ($alreadyRun == true) {
            $message = shell_exec('taskkill /F /IM  Console.exe');
        }

        return response()->json([
            'message' => $message,
        ], 200);
    }
}
