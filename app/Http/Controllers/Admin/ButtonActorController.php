<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ButtonActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.button_actor.index', [
            'buttonActors' => ButtonActor::all()
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
        $all = ButtonActor::all()->pluck('counter_number')->toArray();

        return view('admin.button_actor.create', [
            'codeServices' => Codeservice::all(),
            'listCounters' => array_diff($defaultNumber, $all)
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
            'name' => 'required|string|max:200',
            'unit_service' => 'required|string|exists:codeservice,Initial',
            'counter_number' => 'required|integer|unique:button_actor,counter_number',
            'user_button_code' => 'required|unique:button_actor,user_button_code'
        ])->validate();

        $validated['last_queue_number'] = null;
        $validated['last_queue_called'] = null;

        if (ButtonActor::create($validated)) {
            flash('Sukses menambahkan tombol!')->success();
        } else {
            flash('Gagal menambahkan tombol!')->error();
        }

        return redirect()->route('tombol.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function show(ButtonActor $tombol)
    {
        return view('admin.button_actor.index', [
            'buttonActors' => ButtonActor::all(),
            'tombol' => $tombol
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function edit(ButtonActor $buttonActor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ButtonActor $buttonActor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ButtonActor $tombol)
    {
        if ($tombol->delete()) {
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
