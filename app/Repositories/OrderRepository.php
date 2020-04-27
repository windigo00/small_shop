<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;

class OrderRepository extends AbstractRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = []): Order
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = []): Order
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
        return parent::getPage($request, array_merge(['customer', 'card', 'status'], $with), $columns);
    }
}
