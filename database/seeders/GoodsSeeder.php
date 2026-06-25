<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Goods;
use App\Models\Unit;
use App\Models\GoodsCategory;

class GoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Ambil data Unit yang sudah dibuat sebelumnya di seeder Anda
        $unitPcs = Unit::where('name', 'pieces')->first()?->id;
        $unitBox = Unit::where('name', 'pallet')->first()?->id;

        // 2. Ambil data Kategori untuk dipasangkan ke barang (Many to Many)
        $categoryRawMaterial = GoodsCategory::where('name', 'like', '%Raw Material%')->first();
        $categoryFG = GoodsCategory::where('name', 'like', '%Finish Goods (A)%')->first();
        $categoryReject = GoodsCategory::where('name', 'like', '%Reject%')->first();

        // 3. Data Barang Spesifik (Disesuaikan dengan logic scope stock Anda)
        $goodsData = [
            // Kategori: Elektronik
            [
                'name' => 'Serbuk Kayu',
                'code' => 'RM-A-001',
                'description' => 'Bahan Utama Grade A',
                'minimum_stock' => 10,
                'price' => 150000,
                'stock' => 50, // Masuk scope AvailableStock (>= minimum_stock * 2)
                'unit_id' => $unitPcs,
                'category' => $categoryRawMaterial,
            ],
            [
                'name' => 'Wooden Pallet',
                'code' => 'FG-A-001',
                'description' => 'Pallet Kayu Grade A',
                'minimum_stock' => 5,
                'price' => 1450000,
                'stock' => 8, // Masuk scope LowStock (diantara minimum_stock dan minimum_stock * 2)
                'unit_id' => $unitPcs,
                'category' => $categoryFG,
            ],
            [
                'name' => 'Crack Pallet',
                'code' => 'RT-A-001',
                'description' => 'Pallet Reject Grade A',
                'minimum_stock' => 10,
                'price' => 400000,
                'stock' => 2, // Masuk scope OutOfStock (<= minimum_stock)
                'unit_id' => $unitPcs,
                'category' => $categoryReject,
            ],
        ];

        foreach ($goodsData as $data) {
            // Pisahkan kategori sementara dari array utama
            $categoryModel = $data['category'];
            unset($data['category']);

            // Buat data barang
            $goods = Goods::create($data);

            // Pasangkan ke tabel pivot many-to-many jika kategorinya ditemukan
            if ($goods && $categoryModel) {
                $goods->categories()->attach($categoryModel->id);
            }
        }
    }
}
