<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventMentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_mentor')->insert([
            'event_id' => 1,
            'mentor_id' => 1,
        ]);

        DB::table('event_mentor')->insert([
            'event_id' => 1,
            'mentor_id' => 2,
        ]);
    }
}
