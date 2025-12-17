<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@jdm.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Staff User
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff@jdm.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Create Default Categories
        $categories = [
            ['nama' => 'Engine Parts', 'deskripsi' => 'Komponen mesin dan sistem penggerak', 'warna' => '#ef4444'],
            ['nama' => 'Body Parts', 'deskripsi' => 'Komponen body dan eksterior kendaraan', 'warna' => '#3b82f6'],
            ['nama' => 'Suspension', 'deskripsi' => 'Komponen suspensi dan handling', 'warna' => '#f97316'],
            ['nama' => 'Brake System', 'deskripsi' => 'Sistem pengereman', 'warna' => '#8b5cf6'],
            ['nama' => 'Electrical', 'deskripsi' => 'Kelistrikan dan elektronik', 'warna' => '#eab308'],
            ['nama' => 'Interior', 'deskripsi' => 'Komponen interior kendaraan', 'warna' => '#22c55e'],
            ['nama' => 'Exhaust', 'deskripsi' => 'Sistem knalpot dan exhaust', 'warna' => '#78716c'],
            ['nama' => 'Cooling System', 'deskripsi' => 'Sistem pendingin mesin', 'warna' => '#14b8a6'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
