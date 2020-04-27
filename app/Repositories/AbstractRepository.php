<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\QueueableEntity;

/**
 * Description of AbstractRepository
 *
 * @author windigo
 */
abstract class AbstractRepository implements RepositoryInterface
{
    use Traits\Filterable;
    use Traits\Orderable;
    /**
     *
     * @var QueueableEntity
     */
    protected $model_class;

    public function __construct(QueueableEntity $model)
    {
        $this->model_class = $model;
    }

    /**
     *
     * @param Request $request
     * @param string[] $with
     * @param Columns|null $columns
     * @return LengthAwarePaginator
     */
    public function getPage(Request $request, array $with = [], Columns $columns = null): LengthAwarePaginator
    {
        /* @var $ret \Illuminate\Database\Eloquent\Builder */
        $ret = $this->filter($this->model_class->query(), $request, $columns);
        $ret = $this->order($ret, $request, $columns);
        if (!empty($with)) {
            $ret->with($with);
        }
        // add select names
        $ret->addSelect($ret->getModel()->getTable().'.*');
        if ($columns) {
            /* @var $column \App\Providers\Grid\Column */
            foreach ($columns->getColumns() as $column) {
                $select = $column->getSelectColumn();
                if ($select) {
                    $ret->addSelect(DB::raw("{$column->getSelectColumn()} AS `{$column->getSelectName()}`"));
                }
            }
        }
        return $ret->paginate(config('view.items_per_page'));
    }
}
