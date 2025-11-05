<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'dura.admin@mail.com',
                'password' => Hash::make('dura2025'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
