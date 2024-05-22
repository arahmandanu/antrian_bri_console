<?php

namespace App\Http\Controllers;

use App\Models\TransactionParam;

class DashboardKiosController extends Controller
{
    public const IMAGE_EXTENSION = ['jpg', 'jpeg', 'giv', 'png', 'svg', 'webp'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listKios = scandir(public_path('/iklan_kios'));
        $gambar = [];
        foreach ($listKios as $key => $value) {
            $title = explode('.', $value);
            if (in_array(end($title), $this::IMAGE_EXTENSION)) {
                array_push($gambar, $value);
            }
        }

        return view('kios.shared.main', [
            'listGambar' => $gambar,
        ]);
    }

    public function menuMainIndex()
    {
        return view('kios.index');
    }

    public function menuTeller()
    {
        return view('kios.teller', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', '01')->get()
        ]);
    }

    public function menuCs()
    {
        return view('kios.cs', [
            'buttons' => TransactionParam::show()->where('UnitService', '=', '02')->get()
        ]);
    }
}
