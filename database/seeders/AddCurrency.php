<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddCurrency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = [
            [
                'flag_url' => 'flag/USD.gif',
                'name' => 'USD',
                'jual_a' => '9.235,00',
                'beli_a' => '9.015,00',
                'jual_b' => '9.225,00',
                'beli_b' => '9.025,00',
                'show' => true,
            ],
            [
                'flag_url' => 'flag/SGD.gif',
                'name' => 'SGD',
                'jual_a' => '7.204,00',
                'beli_a' => '7.016,00',
                'jual_b' => '7.194,00',
                'beli_b' => '7.036,00',
                'show' => true,
            ],
            [
                'flag_url' => 'flag/EUR.gif',
                'name' => 'EUR',
                'jual_a' => '12.423,00',
                'beli_a' => '12.255,00',
                'jual_b' => '12.408,00',
                'beli_b' => '12.185,00',
                'show' => true,
            ],
            [
                'flag_url' => 'flag/JPY.gif',
                'name' => 'JPY',
                'jual_a' => '119,12',
                'beli_a' => '115,07',
                'jual_b' => '118,62',
                'beli_b' => '116,12',
                'show' => true,
            ],
            [
                'flag_url' => 'flag/MYR.gif',
                'name' => 'MYR',
                'jual_a' => '3.200,00',
                'beli_a' => '3.100,00',
                'jual_b' => '3.600,00',
                'beli_b' => '3.500,00',
                'show' => true,
            ]
        ];

        Currency::insert($currency);
    }
}
