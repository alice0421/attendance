<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->insert([
            'code' => 's'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
            'name' => 'sample staff',
            'email' => 'sample.staff@gmail.com',
            'password' => Hash::make('sample.staff'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
