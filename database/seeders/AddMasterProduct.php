<?php

namespace Database\Seeders;

use App\Models\MasterProduct;
use Illuminate\Database\Seeder;

class AddMasterProduct extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'BRITAMA (RP)',
                'display_number' => 1,
                'show' => true,
            ],
            [
                'name' => 'BRITAMA (USD)',
                'display_number' => 2,
                'show' => true,
            ],
            [
                'name' => 'GIRO (RP)',
                'display_number' => 3,
                'show' => true,
            ],
            [
                'name' => 'SIMPEDES',
                'display_number' => 4,
                'show' => true,
            ],
            [
                'name' => 'DEPOSITO',
                'display_number' => 5,
                'show' => true,
            ],
            [
                'name' => 'TABUNGANKU',
                'display_number' => 6,
                'show' => true,
            ],
            [
                'name' => 'PENJAMINAN (RP)',
                'display_number' => 7,
                'show' => true,
            ],
            [
                'name' => 'PENJAMINAN (USD)',
                'display_number' => 8,
                'show' => true,
            ],
        ];

        foreach ($data as $key => $value) {
            MasterProduct::create($value);
        }
    }
}
