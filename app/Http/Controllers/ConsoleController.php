<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listCurrency(Currency $currency)
    {
        return response()->json([
            'message' => 'Success',
            'data' => $currency,
        ], 200);
    }
}
