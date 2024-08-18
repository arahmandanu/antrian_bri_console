<?php

namespace App\Http\Middleware;

use App\Models\ButtonActor;
use App\Models\Codeservice;
use App\Models\OriginCustomer;
use App\Models\Properties;
use App\Models\StatConsole;
use App\Models\TempCallWeb;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use starekrow\Lockbox\CryptoKey;

class DashboardMainConsoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $key = CryptoKey::Import(file_get_contents("key.txt"));
            $ciphertext = file_get_contents("cipher.txt");
            $message = $key->Unlock($ciphertext);
            $registered = json_decode($message, true);
            if (empty($registered['company_name']) || empty($registered['company_code'])) return $this->out();

            $configuration = config("site.valid");
            config(['site' => $configuration]);
            $validated = $this->isCompanyValid($registered);
        } catch (\Throwable | \Exception | \ErrorException  $th) {
            $configuration = config("site.invalid");
            config(['site' => $configuration]);
            $validated = $this->isCompanyValid(null);
        }
        if (!$validated) return $this->out();

        $data = StatConsole::first();
        if (empty($data)) {
            $this->initiateTable();
        } else {
            $today = now();
            if ($data->tanggal != $today->format('Ymd')) {
                $this->initiateTable();
            }
        }

        $this->fillTodayStat($data);

        return $next($request);
    }

    private function out()
    {
        return response()->view('errors.subscribe');
    }

    private function isCompanyValid($data)
    {
        if (config('site.allowed')) {
            if (empty($properties = Properties::first())) {
                Properties::create([
                    'company_name' => $data['company_name'],
                    'company_code' => $data['company_code'],
                    'show_product' => true,
                    'show_currency' => true,
                    'footer_flow' => 'left',
                    'footer_flow_kios' => 'left',
                    'printer_name' => null,
                ]);
            } else {
                $properties->update([
                    'company_name' => $data['company_name'],
                    'company_code' => $data['company_code']
                ]);
            }
        } else {
            return false;
        }

        return true;
    }

    private function fillTodayStat($stat)
    {
        $today = now();
        $newData = [
            'tanggal' => $today->format('Ymd'),
            'Status' => 'active',
            'ActiveDate' => $today->format('Ymd'),
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
        ButtonActor::query()->update(['last_queue_number' => null, 'last_queue_called' => null, 'originationcust_SeqDt' => null]);
        Codeservice::query()->update(['CurrentQNo' => 0, 'last_queue' => 0]);
    }
}
