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
            'settings' => Properties::first()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'company_name' => 'required|string|max:244',
            'company_code' => 'required|string|max:244',
            'footer_text' => 'required|string|max:244',
            'show_product' => 'required',
            'show_currency' => 'required',
        ])->validate();

        $record = Properties::first();
        // dd($record, $validated);
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
     * @param  \App\Models\Properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function show(Properties $properties)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function edit(Properties $properties)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Properties $properties)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Properties  $properties
     * @return \Illuminate\Http\Response
     */
    public function destroy(Properties $properties)
    {
        //
    }
}