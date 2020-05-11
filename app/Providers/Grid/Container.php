<?php
namespace App\Providers\Grid;

use App\Repositories\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

/**
 * Description of Grid Container
 *
 * @author windigo
 */
class Container
{

    /**
     *
     * @var RepositoryInterface
     */
    protected RepositoryInterface $repo;

    /**
     *
     * @var Columns
     */
    protected Columns $columns;

    /**
     *
     * @var Request
     */
    protected Request $request;
    /**
     * Query result
     *
     * @var LengthAwarePaginator
     */
    private $result;

    public function __construct(Request $request, RepositoryInterface $repository, Columns $columns)
    {
        $this->request = $request;
        $this->repo = $repository;
        $this->columns = $columns;
    }

    public function getColumns(): array
    {
        return $this->columns->getColumns();
    }

    /**
     * Get array data for json
     * @return array
     */
    public function getColumnData(): array
    {
        return array_map(function(Column\Type $item) { return $item->getData(); }, $this->getColumns());
    }

    public function getActions(): ?array
    {
        return $this->columns->getActions();
    }
    /**
     *
     * @param Request|null $request
     * @return LengthAwarePaginator
     */
    public function getItems(Request $request = null): LengthAwarePaginator
    {
        $request = $request ?: $this->request;
//        $columns = $this->columns->getSelectNames();
//        foreach($this->getColumns() as $column) {
//            /** @var $colummn Column */
//            $columns[] = "{$column->getOrderColumn()} as {$column->getName()}";
//        }
        if ($this->result === null) {
            $this->result = $this->repo->getPage($request, [], $this->columns);

//            $appendAttrs = [];
//
//            $name = config('view.sort_attribute');
//            $sort = $request->input($name);
//            if ($sort) {
//                $appendAttrs[$name] = $sort;
//            }
//
//            $name = config('view.filter_attribute');
//            $filter = $request->input($name);
//            if ($filter) {
//                $appendAttrs[$name] = $filter;
//            }
//            if (!empty($appendAttrs)) {
            $this->result->appends(\Illuminate\Support\Facades\Request::except('page'));
//            }
        }
        return $this->result;
    }
}
