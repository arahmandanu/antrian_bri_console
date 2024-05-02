<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SukuBungaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = null;
        if ($request->input('id')) {
            $search = MasterProduct::findOrFail($request->input('id'));
        }

        $masterProducts = MasterProduct::orderBy('display_number', 'asc')->get();

        return view('admin.product.suku_bunga.index', [
            'masterProducts' => $masterProducts,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $masterProducts = MasterProduct::all();

        return view('admin.product.suku_bunga.create', [
            'masterProducts' => $masterProducts,
        ]);
    }

    // only json
    public function getDisplayNumber(Request $request)
    {
        abort_if(!$request->wantsJson(), 403, 'Invalid request!');

        $product = MasterProduct::findOrFail($request->input('product_id'));
        $usedNumber = $product->productDetails()->pluck('display_number')->toArray();
        $defaultNumber = range(1, 100);

        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff($defaultNumber, $usedNumber));

        return response()->json([
            'display_number' => $canUsed,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'master_product_id' => 'required|integer',
            'value' => 'required|string',
            'suku_bunga' => 'required|string',
            'display_number' => 'required|integer',
        ])->validate();

        if (ProductDetail::create($validated)) {
            flash('Success create product suku bunga!')->success();
        } else {
            flash('Gagal create product suku bunga!')->error();
        }

        return redirect()->route('ConsoleIndexListSukuBunga', ['id' => $request->input('master_product_id')]);
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
    public function edit(ProductDetail $product_detail)
    {
        $usedNumber = ProductDetail::where('master_product_id', '=', $product_detail->id)
            ->whereNot(function ($query) use ($product_detail) {
                $query->where('display_number', $product_detail->display_number);
            })
            ->get()
            ->pluck('id')
            ->toArray();
        $defaultNumber = range(1, 100);

        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff($defaultNumber, $usedNumber));

        return view('admin.product.suku_bunga.edit', [
            'productDetail' => $product_detail,
            'displayNumber' => $canUsed,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetail $product_detail)
    {
        $validated = Validator::make($request->all(), [
            'value' => 'required|string',
            'suku_bunga' => 'required|string',
            'display_number' => 'required|integer',
        ])->validate();

        if ($product_detail->update($validated)) {
            flash('Success mengubah product suku bunga!')->success();
        } else {
            flash('Gagal mengubah product suku bunga!')->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetail $product_detail)
    {
        if ($product_detail->delete()) {
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
