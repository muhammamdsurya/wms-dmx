<?php

namespace Database\Seeders;

use App\Models\GoodsTransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsTransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            // --- Kelompok 1: Receiving (is_receiving = true, operation = addition) ---
            [
                'name' => 'Supplier Purchase',
                'operation' => GoodsTransactionCategory::$additionOperation,
                'description' => 'Penerimaan barang masuk hasil pembelian dari supplier.',
                'is_receiving' => true,
                'is_dispatching' => false,
                'is_locked' => true,
            ],
            [
                'name' => 'Customer Return',
                'operation' => GoodsTransactionCategory::$additionOperation,
                'description' => 'Penerimaan barang kembali (retur) dari pelanggan.',
                'is_receiving' => true,
                'is_dispatching' => false,
                'is_locked' => false,
            ],
            [
                'name' => 'Mutation In',
                'operation' => GoodsTransactionCategory::$additionOperation,
                'description' => 'Penerimaan barang hasil mutasi antar gudang internal.',
                'is_receiving' => true,
                'is_dispatching' => false,
                'is_locked' => false,
            ],

            // --- Kelompok 2: Dispatching (is_dispatching = true, operation = subtraction) ---
            [
                'name' => 'Customer Order Shipment',
                'operation' => GoodsTransactionCategory::$subtractionOperation,
                'description' => 'Pengiriman barang keluar untuk memenuhi pesanan pelanggan.',
                'is_receiving' => false,
                'is_dispatching' => true,
                'is_locked' => true,
            ],
            [
                'name' => 'Supplier Return',
                'operation' => GoodsTransactionCategory::$subtractionOperation,
                'description' => 'Pengembalian barang rusak atau reject kembali ke supplier.',
                'is_receiving' => false,
                'is_dispatching' => true,
                'is_locked' => false,
            ],
            [
                'name' => 'Mutation Out',
                'operation' => GoodsTransactionCategory::$subtractionOperation,
                'description' => 'Pengeluaran barang untuk dimutasi ke gudang internal lain.',
                'is_receiving' => false,
                'is_dispatching' => true,
                'is_locked' => false,
            ],
            [
                'name' => 'Disposal / Scrap',
                'operation' => GoodsTransactionCategory::$subtractionOperation,
                'description' => 'Pembuangan atau pemusnahan barang yang sudah rusak atau kadaluwarsa.',
                'is_receiving' => false,
                'is_dispatching' => true,
                'is_locked' => false,
            ],

            // --- Kelompok 3: Stock Opname (is_receiving & is_dispatching = false, operation = change) ---
            [
                'name' => 'Stock Opname Adjustment',
                'operation' => GoodsTransactionCategory::$changeOperation,
                'description' => 'Penyesuaian stok yang terjadi akibat selisih saat perhitungan fisik gudang.',
                'is_receiving' => false,
                'is_dispatching' => false,
                'is_locked' => true,
            ],
        ];

        foreach ($categories as $category) {
            GoodsTransactionCategory::create($category);
        }
    }
}
