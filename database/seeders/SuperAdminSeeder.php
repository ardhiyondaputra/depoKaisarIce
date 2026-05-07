<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            'id_user' => 1,
            'username' => 'superadmin',
            'password' => Hash::make('superadmin123'),
            'role' => 'super admin',
            'status' => 'aktif',
            'must_change_password' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}