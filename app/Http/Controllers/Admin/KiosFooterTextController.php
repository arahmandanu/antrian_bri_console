<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KiosFooterTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kios.footer_text.index', [
            'footers' => FooterText::kios()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $defaultNumber = range(1, 100);
        $all = FooterText::kios()->pluck('display_number')->toArray();

        return view('admin.kios.footer_text.create', [
            'displayNumbers' => array_diff($defaultNumber, $all),
        ]);
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
            'text' => 'required|string|max:200',
            'display_number' => 'required',
            'show' => 'required',
        ])->validate();

        $validated['type'] = 'kios';
        if (FooterText::create($validated)) {
            flash('Sukses menambahkan currency!')->success();
        } else {
            flash('Gagal menambahkan currency!')->error();
        }

        return redirect()->route('ConsoleIndexKiosFooterText');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterText  $footerText
     * @return \Illuminate\Http\Response
     */
    public function show(FooterText $footerText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterText  $footerText
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterText $footer_text)
    {
        $defaultNumber = range(1, 100);
        $all = FooterText::kios()->where('id', '!=', $footer_text->id)->get()->pluck('display_number')->toArray();

        return view('admin.kios.footer_text.edit', [
            'displayNumbers' => array_diff($defaultNumber, $all),
            'footerText' => $footer_text,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FooterText  $footerText
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FooterText $footer_text)
    {
        $request = Validator::make($request->all(), [
            'text' => 'required|max:200',
            'display_number' => 'required',
            'show' => 'required',
        ])->validate();

        if ($footer_text->update($request)) {
            flash('Sukses mengubah currency!')->success();
        } else {
            flash('Gagal mengubah currency!')->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterText  $footerText
     * @return \Illuminate\Http\Response
     */
    public function destroy(FooterText $footer_text)
    {
        if ($footer_text->delete()) {
            $code = 201;
            $status = 'success';
        } else {
            $code = 422;
            $status = 'Failed';
        }

        return response()->json([
            'status' => $status,
        ], $code);
    }
}
