<?php

namespace Modules\Core\SmallShop\Business\Repository;

use Modules\Core\SmallShop\Business\Model\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use App\Repositories\AbstractRepository;

class TaskRepository extends AbstractRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = array()): Task
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = array()): Task
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

    public function getAll()
    {
        return Task::all();
    }

    public function getForDate(\DateTime $day)
    {
        $start = (clone $day)->modify('midnight');
        $end = (clone $day)->modify('tomorrow midnight');
        return Task::query()->where([
            ['date', '<', $end],
            ['date', '>=', $start]
        ])->get();
    }

    /**
     * @return Task[]
     */
    public function getForMonth(\DateTime $day)
    {
        $start = (clone $day)->modify('first day of this month midnight');
        $end = (clone $day)->modify('first day of next month midnight');
        return Task::query()->where([
            ['date', '<', $end],
            ['date', '>=', $start]
        ])->get();
    }
}
