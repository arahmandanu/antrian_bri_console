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
            'buttonActors' => ButtonActor::orderBy('unit_service', 'asc')->orderBy('counter_number', 'ASC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listCode = (new ButtonActor)->UsedListCounterCode();
        $canUsedCode = [];
        $canUsedCode = array_merge($canUsedCode, array_diff(ButtonActor::LISTCOUNTERCODE, $listCode));

        return view('admin.button_actor.create', [
            'codeServices' => Codeservice::all(),
            'buttonCodes' => $canUsedCode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'unit_service' => 'required|string|exists:codeservice,Initial',
            'counter_number' => 'required|integer',
            'user_button_code' => [
                'required',
                'unique:button_actor,user_button_code',
            ],
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
        $listCode = (new ButtonActor)->UsedListCounterCode();
        $canUsedCode = [];
        $canUsedCode = array_merge($canUsedCode, array_diff(ButtonActor::LISTCOUNTERCODE, $listCode));
        array_unshift($canUsedCode, $tombol->user_button_code);

        $list = (new ButtonActor)->UsedListCounterNumber($tombol->unit_service);
        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff(ButtonActor::LISTNUMBERCOUNTER, $list));
        array_unshift($canUsed, $tombol->counter_number);
        return view('admin.button_actor.edit', [
            'codeServices' => Codeservice::all(),
            'listCounters' => $canUsed,
            'buttonCodes' => $canUsedCode,
            'tombol' => $tombol,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ButtonActor $buttonActor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\ButtonActor  $buttonActor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ButtonActor $tombol)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'counter_number' => [
                "required",
                "integer",
                Rule::unique('button_actor')->where(
                    fn($query) => $query
                        ->where('id', '==', $tombol->id)
                        ->orWhere('unit_service', '==', $tombol->user_button_code)
                )
            ],
            'user_button_code' => [
                "required",
                Rule::unique('button_actor')->where(
                    fn($query) => $query
                        ->where('id', '==', $tombol->id)
                        ->orWhere('unit_service', '==', $tombol->user_button_code)
                )
            ],
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

        $list = (new ButtonActor)->UsedListCounterNumber($unitService);
        $canUsed = [];
        $canUsed = array_merge($canUsed, array_diff(ButtonActor::LISTNUMBERCOUNTER, $list));

        return response()->json([
            'display_number' => $canUsed
        ], 200);
    }
}
