<?php

namespace App\Http\Middleware;

use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\StatConsole;
use App\Models\TempCallWeb;
use Closure;
use Illuminate\Http\Request;

class DashboardMainConsoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data = StatConsole::first();
        if (empty($data)) {
            $this->initiateTable();
        } else {
            $today = now();
            if ($data->tanggal != $today->format('Ymd')) $this->initiateTable();
        }

        $this->fillTodayStat($data);
        return $next($request);
    }

    private function fillTodayStat($stat)
    {
        $today = now();
        $newData = [
            'tanggal' => $today->format('Ymd'),
            'Status' => 'active',
            'ActiveDate' =>  $today->format('Ymd'),
        ];

        if (empty($stat)) {
            StatConsole::create($newData);
        } else {
            $stat->update($newData);
        }
    }

    private function initiateTable()
    {
        OriginCustomer::truncate();
        TempCallWeb::truncate();
        ButtonActor::query()->update(['last_queue_number' => null, 'last_queue_called' => null]);
        Codeservice::query()->update(['CurrentQNo' => 0, 'last_queue' => 0]);
    }
}
