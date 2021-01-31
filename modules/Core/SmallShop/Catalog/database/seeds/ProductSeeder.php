<?php
namespace Modules\Core\SmallShop\Catalog\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\SmallShop\Catalog\Model\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Product::class, 300)->create();
    }
}
