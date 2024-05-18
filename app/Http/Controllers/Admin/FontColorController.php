<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FontColor;
use App\Models\Properties;
use Illuminate\Http\Request;

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
            'properties' => Properties::first(),
        ]);
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
    public function reset(FontColor $font_color)
    {
        if ($font_color->update(['value' => null])) {
            flash('Sukses mereset warna!')->success();
        } else {
            flash('Gagal mereset warna!')->error();
        }

        return redirect()->back();
    }
}
