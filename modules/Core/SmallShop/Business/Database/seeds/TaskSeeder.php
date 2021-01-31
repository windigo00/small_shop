<?php
namespace Modules\Core\SmallShop\Business\Database\Seeds;

use Illuminate\Database\Seeder;
use Modules\Core\SmallShop\Business\Model\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Task::class, 10)->create();
    }
}
