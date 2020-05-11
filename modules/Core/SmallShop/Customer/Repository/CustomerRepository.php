<?php

namespace Modules\Core\SmallShop\Customer\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use App\Repositories\AbstractRepository;

class CustomerRepository extends AbstractRepository
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
    public function create(array $modelData = array()): Customer
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = array()): Customer
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
        return parent::getPage($request, array_merge(['user'], $with), $columns);
    }
}
