<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuperAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
// Menggunakan updateOrCreate agar jika data sudah ada, tidak terjadi error/duplikasi
    $superAdmin = User::updateOrCreate(
        ['email' => 'superadmin@example.com'], // Kriteria unik
        [
            'name' => 'Super Admin',
            'password' => ('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]
    );
    $superAdmin->assignRole('Super Admin');

    $warehouseAdmin = User::updateOrCreate(
        ['email' => 'warehouseadmin@example.com'], // Kriteria unik
        [
            'name' => 'Warehouse Admin',
            'password' => ('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]
    );
    $warehouseAdmin->assignRole('Warehouse Admin');
    }
}
