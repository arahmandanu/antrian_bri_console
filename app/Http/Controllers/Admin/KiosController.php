<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionParam;
use Illuminate\Http\Request;

class KiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.kios.index', [
            'Services' => TransactionParam::enabled()->get(),
        ]);
    }

    public function toogle(Request $request, TransactionParam $transaction_param, $status)
    {
        $transaction_param->displayed = ($status == 'hide') ? false : true;
        if ($transaction_param->save()) {
            flash('Sukses merubah menu kios!')->success();
        } else {
            flash('Gagal merubah menu kios!')->error();
        }

        return redirect()->back();
    }
}
