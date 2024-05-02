<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.currency.index', [
            'listCurrecy' => Currency::where('show', '=', true)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Validator::make($request->all(), [
            'flag' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024',
            'name' => 'required',
            'jual_a' => 'required',
            'beli_a' => 'required',
            'jual_b' => 'required',
            'jual_b' => 'required',
        ])->validate();

        $images = $request->flag;
        $imageName = time().'.'.$images->extension();

        try {
            $url_path = $images->move(Currency::FLAG_PATH, $imageName);
        } catch (\Throwable $th) {
            flash('Gagal menyimpan gambar! silahkan hubungi admin anda!')->error();

            return redirect()->back();
        }

        $row = $request->input();
        $row['flag_url'] = $url_path;

        if (Currency::create($row)) {
            flash('Sukses menambahkan Suku bunga!')->success();
        } else {
            flash('Gagal menambahkan Suku bunga!')->error();
        }

        return redirect()->route('ConsoleIndexCurrency');
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
