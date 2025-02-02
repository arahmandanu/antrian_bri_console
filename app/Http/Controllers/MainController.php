<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\FontColor;
use App\Models\FooterText;
use App\Models\MasterProduct;
use App\Models\Properties;
use App\Models\TempCallWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

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

        $listQueues = TempCallWeb::doneCalled()->listNewest()->take(3)->get();
        $datalistQueues = [];
        foreach ($listQueues as $key => $queue) {
            array_push($datalistQueues, $queue);
        }

        $data['show_product'] = $properties->show_product ?? true;
        $data['show_currency'] = $properties->show_currency ?? true;
        $data['show_both'] = $data['show_product'] && $data['show_currency'];
        $data['list_footer_text'] = FooterText::show()->get();
        $data['footer_flow'] = $properties->footer_flow ?? 'right';
        $data['videos'] = $videos;
        $data['images'] = $images;
        $data['company_name'] = $properties->company_name ?? null;
        $data['historyQueues'] = $datalistQueues;

        $colors = FontColor::where('value', '!=', null)->get();
        foreach ($colors as $key => $value) {
            $data[$value->name] = $value->value;
        }

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
        // $task_list = [];
        // exec('start /B tasklist /nh /fi "ImageName eq Console.exe"', $task_list);
        // $message = null;
        // $enabler = true;
        // foreach ($task_list as $key => $value) {
        //     if ($value !== '') {
        //         if (str_contains($value, 'Console.exe')) {
        //             $enabler = false;
        //             $message = 'Console sudah aktif sebelumnya!';
        //         }
        //     }
        // }

        // if ($enabler == true) {
        //     $path = base_path('call_console.php');
        //     // exec("php $path", $test);
        //     pclose(popen('start /B cmd /C "php ' . $path . ' >NUL 2>NUL"', 'r'));
        //     $message = 'Console berhasil di jalankan!';
        // }

        // return response()->json([
        //     'success' => true,
        //     'message' => $message,
        // ], 200);
    }

    public function closeConsole(Request $request)
    {
        $task_list = [];
        exec('start /B tasklist /nh /fi "ImageName eq Console.exe"', $task_list);
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
