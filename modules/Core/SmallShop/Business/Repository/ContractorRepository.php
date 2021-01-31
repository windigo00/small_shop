<?php

namespace Modules\Core\SmallShop\Business\Repository;

use Modules\Core\SmallShop\Business\Model\Contractor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use App\Repositories\AbstractRepository;

class ContractorRepository extends AbstractRepository
{
    public function __construct(Contractor $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = []): Contractor
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = []): Contractor
    {
    }

    /**
     * @param Request $request
     * @param string[] $with
     * @param Columns|null $columns
     * @return LengthAwarePaginator
     */
    public function getPage(Request $request, array $with = [], ?Columns $columns = null): LengthAwarePaginator
    {
        return parent::getPage($request, $with, $columns);
    }

    public function getAll()
    {
        return Contractor::all();
    }
}
