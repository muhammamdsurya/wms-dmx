<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoodsCategory;

class GoodsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Raw Material',
                'description' => 'Bahan mentah untuk produksi',
                'created_by' => null, // Bisa diisi UUID User jika ada sistem auth
                'updated_by' => null,
            ],
            [
                'name' => 'Finish Goods (A)',
                'description' => 'Produk jadi siap jual',
                'created_by' => null,
                'updated_by' => null,
            ],
            [
                'name' => 'Reject',
                'description' => 'Produk Not Good',
                'created_by' => null,
                'updated_by' => null,
            ],

        ];

        foreach ($categories as $category) {
            GoodsCategory::create($category);
        }
    }
}
