<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('super_admins')->insert([
            'id' => Str::uuid(),
            'username' => 'superadmin',
            'password' => Hash::make('securepassword'), // Menggunakan hash untuk keamanan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
