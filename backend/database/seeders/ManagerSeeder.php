<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'code' => 's'. (string) str_pad(random_int(0, 999999), 6,0, STR_PAD_LEFT),
            'name' => 'sample manager',
            'email' => 'sample.manager@gmail.com',
            'password' => Hash::make('sample.manager'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
