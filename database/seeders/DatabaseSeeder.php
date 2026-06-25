<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Goods;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UnitSeeder::class,
            RoleSeeder::class,
            SuperAdminUserSeeder::class,
            PermissionSeeder::class,
            GoodsTransactionCategorySeeder::class,
            GoodsCategorySeeder::class,
            GoodsSeeder::class,
            SupplierSeeder::class,
            ShipperSeeder::class,
        ]);
    }
}
