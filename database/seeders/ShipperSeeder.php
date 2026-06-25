<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipper;

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippers = [
            [
                'name' => 'JNE Express Logistics',
                'cp_phone' => '02129278888',
            ],
            [
                'name' => 'J&T Cargo & Express',
                'cp_phone' => '0211020000',
            ],
            [
                'name' => 'Sicepat Ekspres',
                'cp_phone' => '02150200050',
            ],
            [
                'name' => 'Anteraja Logistics',
                'cp_phone' => '02150663333',
            ],
            [
                'name' => 'DHL Supply Chain Indonesia',
                'cp_phone' => '02129535300',
            ],
            [
                'name' => 'Gudang Internal Fleet (Kurir Sendiri)',
                'cp_phone' => '08123456789', // Kontak internal dispatcher gudang
            ],
        ];

        foreach ($shippers as $shipper) {
            Shipper::create($shipper);
        }
    }
}
