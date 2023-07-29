<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'name' => '入学式',
            'start_date' => '2023-07-01',
            'end_date' => '2023-07-01',
            'start_time' => '12:00:00',
            'end_time' => '15:00:00',
        ]);
    }
}
