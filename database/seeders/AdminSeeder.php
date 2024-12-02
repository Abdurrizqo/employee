<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Ranting; // Pastikan model Ranting sudah ada
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inisialisasi Faker
        $faker = Faker::create();

        // Ambil semua ID ranting
        $rantings = Ranting::all()->pluck('id')->toArray();

        // Buat 100 admin secara acak
        foreach (range(1, 123) as $index) {
            Admin::create([
                'id' => Str::uuid(), // UUID untuk ID
                'username' => $faker->userName,
                'password' => Hash::make($faker->password), // Password terenkripsi
                'nama_admin' => $faker->name,
                'is_active' => $faker->boolean, // true or false
                'id_ranting' => $faker->randomElement($rantings), // Ambil ID ranting acak
            ]);
        }
    }
}
