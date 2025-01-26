<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.properties.index', [
            'settings' => Properties::first(),
        ]);
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
        $validated = Validator::make($request->all(), [
            'show_product' => 'required',
            'show_currency' => 'required',
            'footer_flow' => 'required|in:left,right',
            'footer_flow_kios' => 'required|in:left,right',
            'printer_name' => 'nullable',
        ])->validate();

        $record = Properties::first();

        if ($record) {
            if ($record->update($validated)) {
                flash('Sukses menambahkan Properties!')->success();
            } else {
                flash('Gagal menambahkan Properties!')->error();
            }
        } else {
            if (Properties::create($validated)) {
                flash('Sukses mengubah Properties!')->success();
            } else {
                flash('Gagal mengubah Properties!')->error();
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Properties $properties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Properties $properties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Properties $properties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Properties $properties)
    {
        //
    }
}
