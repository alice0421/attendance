<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // メンター
        DB::table('users')->insert([
            'code' => 'm'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
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

        DB::table('users')->insert([
            'code' => 'm'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
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

        DB::table('users')->insert([
            'code' => 'm'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
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

        // 運営
        DB::table('users')->insert([
            'code' => 's'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
            'name' => 'sample staff',
            'is_admin' => true,
            'is_remote' => false,
            'work_day' => 0,
            'state' => 0,
            'email' => 'sample.staff@gmail.com',
            'password' => Hash::make('sample.staff'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
