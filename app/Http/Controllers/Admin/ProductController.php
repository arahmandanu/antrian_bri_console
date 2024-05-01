<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listProducts = MasterProduct::orderBy('display_number', 'asc')->get();

        return view('admin.product.index', ['listProducts' => $listProducts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // DEFAULT NUMBER DISPLAY
        $defaultNumber = range(1, 100);
        $all = MasterProduct::all()->pluck('display_number')->toArray();

        return view('admin.product.create', ['displayNumbers' => array_diff($defaultNumber, $all)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'display_number' => 'required|unique:master_products,display_number',
            'show' => 'required',
        ])->validate();

        if (MasterProduct::create($request->only(['name', 'display_number', 'show']))) {
            flash('Sukses menambahkan product!')->success();
        } else {
            flash('Gagal menambahkan product!')->error();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MasterProduct $masterProduct)
    {
        // DEFAULT NUMBER DISPLAY
        $defaultNumber = range(1, 100);
        $all = MasterProduct::where('id', '!=', $masterProduct->id)->get()->pluck('display_number')->toArray();

        return view('admin.product.show', [
            'displayNumbers' => array_diff($defaultNumber, $all),
            'masterProduct' => $masterProduct,
        ]);
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
    public function update(Request $request, MasterProduct $masterProduct)
    {
        if ($masterProduct->update($request->only(['name', 'display_number', 'show']))) {
            flash('Sukses merubah product!')->success();
        } else {
            flash('Gagal merubah product!')->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterProduct $masterProduct)
    {
        if ($masterProduct->delete()) {
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
