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
            'listCurrecy' => Currency::all(),
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
        Validator::make($request->all(), [
            'flag' => 'required|file|mimes:jpg,jpeg,png,gif|max:1024',
            'name' => 'required',
            'jual_a' => 'required',
            'beli_a' => 'required',
            'jual_b' => 'required',
            'beli_b' => 'required',
            'show' => 'required'
        ])->validate();

        $images = $request->flag;
        $imageName = time() . '.' . $images->extension();

        try {
            $url_path = $images->move(Currency::FLAG_PATH, $imageName);
        } catch (\Throwable $th) {
            flash('Gagal menyimpan gambar! silahkan hubungi admin anda!')->error();

            return redirect()->back();
        }

        $row = $request->input();
        $row['flag_url'] = $url_path;

        if (Currency::create($row)) {
            flash('Sukses menambahkan currency!')->success();
        } else {
            flash('Gagal menambahkan currency!')->error();
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
    public function edit(Currency $currency)
    {
        return view('admin.currency.edit', ['currency' => $currency]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $request = Validator::make($request->all(), [
            'name' => 'required',
            'jual_a' => 'required',
            'beli_a' => 'required',
            'jual_b' => 'required',
            'beli_b' => 'required',
            'show' => 'required'
        ])->validate();

        if ($currency->update($request)) {
            flash('Sukses mengubah currency!')->success();
        } else {
            flash('Gagal mengubah currency!')->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $file_path = $currency->flag_url;
        if ($currency->delete()) {
            if (file_exists(public_path($file_path))) {
                unlink(public_path($file_path));
            }
            $status = 'Success delete data!';
            $code = 201;
        } else {
            $status = 'Gagal delete data';
            $code = 422;
        }

        return response()->json([
            'status' => $status,
        ], $code);
    }
}
