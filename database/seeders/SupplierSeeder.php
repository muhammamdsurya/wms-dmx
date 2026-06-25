<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            [
                'name' => 'PT Demak Indah Kencana',
                'address' => 'Kawasan Industri Jababeka Tahap V Blok C No. 12, Cikarang, Bekasi',
                'cp_name' => 'Budi Santoso',
                'cp_phone' => '081234567890',
            ],
            [
                'name' => 'CV Pangan Mandiri Utama',
                'address' => 'Jl. Raden Saleh No. 45, Bubutan, Surabaya',
                'cp_name' => 'Siti Rahmawati',
                'cp_phone' => '081987654321',
            ],
            [
                'name' => 'PT Tekstil Garment Nusantara',
                'address' => 'Jl. Jend. Sudirman No. 102, Bandung',
                'cp_name' => 'Hendra Wijaya',
                'cp_phone' => '082111222333',
            ],
            [
                'name' => 'PT Global Logistics & Supply',
                'address' => 'Jl. Lodan Raya No. 2, Ancol, Jakarta Utara',
                'cp_name' => 'Rian Hidayat',
                'cp_phone' => '085744556677',
            ],
            [
                'name' => 'CV Alkes Medica Indonesia',
                'address' => 'Jl. Kaliurang KM 7, Sinduadi, Sleman, Yogyakarta',
                'cp_name' => 'dr. Amalia Putri',
                'cp_phone' => '081399887766',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
