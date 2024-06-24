<?php

namespace Database\Seeders;

use App\Enum\CodeServiceEnum;
use App\Models\Codeservice;
use Illuminate\Database\Seeder;

class CreateCodeServiceData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Codeservice::insert([
            [
                'Name' => 'Teller Umum',
                'Initial' => CodeServiceEnum::TELLER,
                'CurrentQNo' => 0,
                'last_queue' => 0,
            ],
            [
                'Name' => 'CS Umum',
                'Initial' => CodeServiceEnum::CS,
                'CurrentQNo' => 0,
                'last_queue' => 0,
            ],
        ]);
    }
}
