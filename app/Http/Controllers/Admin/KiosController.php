<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Codeservice;
use App\Models\TransactionParam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.kios.index', [
            'Services' => TransactionParam::all(),
        ]);
    }

    public function toogle(Request $request, TransactionParam $transaction_param, $status)
    {
        $status = ($status == 'hide') ? false : true;
        if ($status === false) {
            if (TransactionParam::where('UnitService', '=', $transaction_param->UnitService)->show()->count() == 1) {
                flash('Gagal merubah menu kios! minimal 1 menu tertampil')->error();

                return redirect()->back();
            }
        }

        $transaction_param->displayed = $status;
        if ($transaction_param->save()) {
            flash('Sukses merubah menu kios!')->success();
        } else {
            flash('Gagal merubah menu kios!')->error();
        }

        return redirect()->back();
    }

    public function edit(TransactionParam $transaction_param)
    {
        $range = explode(':', $transaction_param->Tservice);

        return view('admin.kios.edit', ['transactionParam' => $transaction_param, 'range' => $range[1]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kios.create', [
            'codeServices' => Codeservice::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionParam $transaction_param)
    {
        $validated = Validator::make($request->all(), [
            'TrxName' => 'required|max:200',
            'Tservice' => 'required|integer',
        ])->validate();

        $sla = (strlen($validated['Tservice']) == 1 ? '0' . $validated['Tservice'] : $validated['Tservice']);
        $validated['Tservice'] = "00:$sla:00";

        if ($transaction_param->update($validated)) {
            flash('Sukses merubah menu kios!')->success();
        } else {
            flash('Gagal merubah menu kios!')->error();
        }

        return redirect()->route('ConsoleIndexKios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'TrxCode' => 'required|string|max:4|unique:trxparam,TrxCode',
            'TrxName' => 'required|max:200',
            'UnitService' => 'required|exists:codeservice,Initial',
            'Tservice' => 'required|integer',
        ])->validate();

        $sla = (strlen($validated['Tservice']) == 1 ? '0' . $validated['Tservice'] : $validated['Tservice']);
        $validated['Tservice'] = "00:$sla:00";

        if (TransactionParam::create($validated)) {
            flash('Sukses menambahkan menu kios!')->success();
        } else {
            flash('Gagal menambahkan menu kios!')->error();
        }

        return redirect()->route('ConsoleIndexKios');
    }
}
