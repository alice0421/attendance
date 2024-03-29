<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // メンター
        DB::table('mentors')->insert([
            'code' => 'm'. (string) str_pad((string) random_int(0, 999999), 6, "0", STR_PAD_LEFT),
            'name' => 'remote mentor',
            'is_admin' => false,
            'is_remote' => true,
            'work_day' => 3,
            'state' => 0,
            'email' => 'remote.mentor@gmail.com',
            'password' => Hash::make('remote.mentor'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('mentors')->insert([
            'code' => 'm'. (string) str_pad((string) random_int(0, 999999), 6, "0", STR_PAD_LEFT),
            'name' => 'office mentor',
            'is_admin' => false,
            'is_remote' => false,
            'work_day' => 2,
            'state' => 0,
            'email' => 'office.mentor@gmail.com',
            'password' => Hash::make('office.mentor'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('mentors')->insert([
            'code' => 'm'. (string) str_pad((string) random_int(0, 999999), 6, "0", STR_PAD_LEFT),
            'name' => 'admin mentor',
            'is_admin' => true,
            'is_remote' => false,
            'work_day' => 4,
            'state' => 0,
            'email' => 'admin.mentor@gmail.com',
            'password' => Hash::make('admin.mentor'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
