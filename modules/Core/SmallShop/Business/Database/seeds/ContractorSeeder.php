<?php
namespace Modules\Core\SmallShop\Business\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\SmallShop\Business\Model\Contractor;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Contractor::class, 10)->create();
    }
}
