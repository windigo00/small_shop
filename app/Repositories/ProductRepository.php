<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;

class ProductRepository extends AbstractRepository
{
    protected $model_class = Product::class;
    public function create(array $modelData = array()): Model {

    }

    public function delete(int $id): void {

    }

    public function update(array $modelData = array()): Model {

    }
}
