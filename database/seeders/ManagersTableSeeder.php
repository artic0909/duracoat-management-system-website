<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManagersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('managers')->insert([
            [
                'name' => 'Duracoat Manager',
                'email' => 'dura.manager@mail.com',
                'password' => Hash::make('dura2025'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
