<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ButtonActor;
use App\Models\Codeservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'buttonActors' => ButtonActor::orderBy('unit_service', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.button_actor.create', [
            'codeServices' => Codeservice::all()
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
            'counter_number' => 'required|integer',
            'user_button_code' => [
                'required', 'unique:button_actor,user_button_code'
            ]
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
        $defaultNumber = range(1, 100);
        $all = ButtonActor
            ::where('id', '!=', $tombol->id)
            ->where('unit_service', '=', $tombol->unit_service)
            ->pluck('counter_number')->toArray();

        return view('admin.button_actor.edit', [
            'buttonActors' => ButtonActor::all(),
            'codeServices' => Codeservice::all(),
            'listCounters' => array_diff($defaultNumber, $all),
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
    public function update(Request $request, ButtonActor $tombol)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'counter_number' => "required|integer|unique:button_actor,counter_number,$tombol->id",
            'user_button_code' => "required|unique:button_actor,user_button_code,$tombol->id"
        ])->validate();

        if ($tombol->update($validated)) {
            flash('Sukses mengubah tombol!')->success();
        } else {
            flash('Gagal mengubah tombol!')->error();
        }

        return redirect()->back();
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

    public function getCounterNumber(Request $request, $unitService)
    {
        abort_if(!$request->wantsJson(), 403, 'Invalid request!');

        $defaultNumber = range(1, 100);
        if (empty($request->input('currentId'))) {
            $usedNumber = ButtonActor::where('unit_service', '=', $unitService)->pluck('counter_number')->toArray();
        }

        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff($defaultNumber, $usedNumber));

        return response()->json([
            'display_number' => $canUsed,
        ], 200);
    }
}
