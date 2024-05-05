<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\MasterProduct;
use App\Models\Properties;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public const FLAG_PATH = ['mov', 'mp4', 'flv', 'mpg', 'mpeg', 'mpv'];

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
            if (in_array(end($title), $this::FLAG_PATH)) {
                array_push($videos, $value);
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

        $data['show_product'] = $properties->show_product ?? true;
        $data['show_currency'] = $properties->show_currency ?? true;
        $data['show_both'] = $data['show_product'] && $data['show_currency'];
        $data['footer_text'] = $properties->footer_text ?? null;
        $data['videos'] = $videos;

        return view('shared.main', $data);
    }

    public function videosList(Request $request)
    {
        abort_if(! $request->wantsJson(), 403, 'Invalid request!');

        $listFile = scandir(public_path('/video'));
        $videos = [];
        foreach ($listFile as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::FLAG_PATH)) {
                array_push($videos, $value);
            }
        }

        return response()->json([
            'videos' => $videos,
        ], 200);
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
