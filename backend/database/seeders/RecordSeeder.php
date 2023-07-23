<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 出勤
        DB::table('records')->insert([
            'user_id' => 1,
            'record_type' => 0,
            'is_remote' => true,
            'date' => '2023-07-21',
            'time' => '14:00:00',
            'error' => false,
        ]);

        // 休憩開始
        DB::table('records')->insert([
            'user_id' => 1,
            'record_type' => 1,
            'is_remote' => true,
            'date' => '2023-07-21',
            'time' => '18:23:00',
            'error' => false,
        ]);

        // 休憩終了
        DB::table('records')->insert([
            'user_id' => 1,
            'record_type' => 2,
            'is_remote' => true,
            'date' => '2023-07-21',
            'time' => '19:08:00',
            'error' => false,
        ]);

        // 退勤
        DB::table('records')->insert([
            'user_id' => 1,
            'record_type' => 3,
            'is_remote' => true,
            'date' => '2023-07-21',
            'time' => '22:00:00',
            'error' => false,
        ]);
    }
}
