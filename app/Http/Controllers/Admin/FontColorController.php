<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FontColor;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FontColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.properties.font_color.index', [
            'fontColors' => FontColor::all(),
            'properties' => Properties::first()
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
            'company_name' => 'required|string|max:244',
            'company_code' => 'required|string|max:244',
            'show_product' => 'required',
            'show_currency' => 'required',
            'footer_flow' => 'required|in:left,right'
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
    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $text = FontColor::where('name', '=', $request->input('id'))->first();
        if ($text) {
            if ($text->update(['value' => $request->value])) {
                $status = 'Success change your color';
                $code = 201;
            } else {
                $status = 'Failed to update, please contact your developers!';
                $code = 422;
            }
        } else {
            $status = 'Not Found';
            $code = 404;
        }

        return response()->json([
            'status' => $status,
        ], $code);
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
