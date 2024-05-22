<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\TransactionCustomer;
use App\Models\TransactionParam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $queryDate = self::getfromToDateRange($request->input('datetimes'));
        $trxParam = $request->input('trx_param');
        $typeSla = $request->input('type_sla');

        if ($queryDate[0]->diffInMonths($queryDate[1]) >= 4) {
            flash()->error('Maksimal Pencarian 3 bulan');
            return redirect()->route('ConsoleIndexReport');
        }

        $transactions = TransactionCustomer::select('transactioncust.*', 'trxparam.*')
            ->leftJoin('trxparam', 'transactioncust.TrxDesc', '=', 'trxparam.TrxCode')
            ->when($queryDate, function ($query, $queryDate) {
                $query->whereBetween('BaseDt', [$queryDate[0]->isoFormat('OYMMDD'), $queryDate[1]->isoFormat('OYMMDD')]);
            })
            ->when($trxParam, function ($query, $trxParam) {
                $query->where('TrxDesc', $trxParam);
            })
            ->when($typeSla, function ($query, $typeSla) {
                if ($typeSla == 'over') {
                    return $query->whereNotIn('TOverSLA', ['00:00:00']);
                } else {
                    return  $query->whereIn('TOverSLA', ['00:00:00']);
                }
            })
            ->whereNotNull('TOverSLA')
            ->get();

        session()->flashInput($request->input());
        return view('admin.report.index', [
            'transactions' => $transactions,
            'transactionType' => TransactionParam::enabled()->get()
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
