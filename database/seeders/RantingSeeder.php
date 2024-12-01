<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RantingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rantings = [
            ['id' => Str::uuid(), 'nama_ranting' => 'ranting1', 'is_active' => true],
            ['id' => Str::uuid(), 'nama_ranting' => 'ranting2', 'is_active' => true],
            ['id' => Str::uuid(), 'nama_ranting' => 'ranting3', 'is_active' => true],
            ['id' => Str::uuid(), 'nama_ranting' => 'ranting4', 'is_active' => true],
            ['id' => Str::uuid(), 'nama_ranting' => 'ranting5', 'is_active' => false],
        ];

        DB::table('rantings')->insert($rantings);
    }
}
