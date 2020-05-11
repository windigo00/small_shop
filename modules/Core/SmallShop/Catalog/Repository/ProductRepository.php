<?php

namespace Modules\Core\SmallShop\Catalog\Repository;

use Modules\Core\SmallShop\Catalog\Model\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use App\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = array()): Product
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = array()): Product
    {
    }
    /**
     *
     * @param Request $request
     * @param string[] $with
     * @param Columns|null $columns
     * @return LengthAwarePaginator
     */
    public function getPage(Request $request, array $with = [], ?Columns $columns = null): LengthAwarePaginator
    {
        return parent::getPage($request, $with, $columns);
    }
}
