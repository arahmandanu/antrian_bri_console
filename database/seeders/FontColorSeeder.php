<?php

namespace Database\Seeders;

use App\Models\FontColor;
use Illuminate\Database\Seeder;

class FontColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FontColor::insert([
            [
                'name' => 'unit_name',
                'value' => null,
            ],
            [
                'name' => 'current_queue',
                'value' => null,
            ],
            [
                'name' => 'first_log',
                'value' => null,
            ],
            [
                'name' => 'second_log',
                'value' => null,
            ],
            [
                'name' => 'watch',
                'value' => null,
            ],
            [
                'name' => 'footer_text',
                'value' => null,
            ],
        ]);
    }
}
