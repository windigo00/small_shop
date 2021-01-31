<?php

namespace Modules\Core\SmallShop\User\Repository;

use Modules\Core\SmallShop\User\Model\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use App\Repositories\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = array()): User
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = []): User
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
        return parent::getPage($request, array_merge(['authRule'], $with), $columns);
    }
}
