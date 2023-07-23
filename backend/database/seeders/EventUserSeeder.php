<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_user')->insert([
            'event_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('event_user')->insert([
            'event_id' => 1,
            'user_id' => 2,
        ]);
    }
}
