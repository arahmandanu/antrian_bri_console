<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\MasterProduct;
use App\Models\Properties;
use App\Models\TempCallWeb;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public const VIDEO_EXTENSION = ['mov', 'mp4', 'flv', 'mpg', 'mpeg', 'mpv'];

    public const IMAGE_EXTENSION = ['jpg', 'jpeg', 'giv', 'png', 'svg', 'webp'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listFile = scandir(public_path('/video'));
        $videos = [];
        foreach ($listFile as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::VIDEO_EXTENSION)) {
                array_push($videos, $value);
            }
        }

        $listImages = scandir(public_path('/iklan_image'));
        $images = [];
        foreach ($listImages as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::IMAGE_EXTENSION)) {
                array_push($images, $value);
            }
        }

        $data = [];
        $properties = Properties::first();
        if ($properties) {
            if ($properties->show_product) {
                $data['products'] = MasterProduct::Show()->get();
            } else {
                $data['products'] = [];
            }

            if ($properties->show_currency) {
                $data['currencies'] = Currency::show()->get();
            } else {
                $data['currencies'] = [];
            }
        } else {
            $data['products'] = MasterProduct::Show()->get();
            $data['currencies'] = Currency::show()->get();
        }

        $listQueues = TempCallWeb::listNewest()->take(3)->get();
        $datalistQueues = [];
        foreach ($listQueues as $key => $queue) {
            array_push($datalistQueues, $queue);
        }

        $data['show_product'] = $properties->show_product ?? true;
        $data['show_currency'] = $properties->show_currency ?? true;
        $data['show_both'] = $data['show_product'] && $data['show_currency'];
        $data['footer_text'] = $properties->footer_text ?? null;
        $data['videos'] = $videos;
        $data['images'] = $images;
        $data['company_name'] = $properties->company_name ?? null;
        $data['historyQueues'] = $datalistQueues;

        return view('shared.main', $data);
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
        exec('start /B tasklist 2>NUL', $task_list);
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
            // dd($test);
            pclose(popen('start /B cmd /C "php ' . $path . ' >NUL 2>NUL"', 'r'));
            $message = 'Console berhasil di jalankan!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ], 200);
    }

    public function closeConsole(Request $request)
    {
        dd('masukl');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
