<?php

namespace Database\Seeders;

use App\Enum\CodeServiceEnum;
use App\Models\TransactionParam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeedTrxParamsData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        TransactionParam::insert([
            [
                'TrxCode' => '1111',
                'TrxName' => 'SETOR TELLER',
                'UnitService' => CodeServiceEnum::TELLER,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '1112',
                'TrxName' => 'PENGAMBILAN TELLER',
                'UnitService' => CodeServiceEnum::TELLER,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '1113',
                'TrxName' => 'KLIRING',
                'UnitService' => CodeServiceEnum::TELLER,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '1114',
                'TrxName' => 'TRANSFER VIA TELLER',
                'UnitService' => CodeServiceEnum::TELLER,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '1115',
                'TrxName' => 'LAIN LAIN',
                'UnitService' => CodeServiceEnum::TELLER,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],

            [
                'TrxCode' => '2226',
                'TrxName' => 'KLOMPLAIN NASABAH',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2225',
                'TrxName' => 'BLOKIR REKENING',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2224',
                'TrxName' => 'GANTI ATM',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2223',
                'TrxName' => 'BUKA DEPOSITO',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2222',
                'TrxName' => 'BUKA INTERNET BANKING',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2221',
                'TrxName' => 'BUKA TABUNGAN',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
            [
                'TrxCode' => '2220',
                'TrxName' => 'LAIN-LAIN',
                'UnitService' => CodeServiceEnum::CS,
                'Tservice' => '00:05:00',
                'displayed' => true
            ],
        ]);
    }
}
