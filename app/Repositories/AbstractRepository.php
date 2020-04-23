<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
/**
 * Description of AbstractRepository
 *
 * @author windigo
 */
abstract class AbstractRepository implements RepositoryInterface {
    use Traits\Filterable;
    use Traits\Orderable;

    protected $model_class;

    public function getPage(Request $request, array $with = []): LengthAwarePaginator {
        $ret = $this->filter($this->model_class::query(), $request);
        $ret = $this->order($ret, $request);
        if (!empty($with)) {
            $ret->with($with);
        }
        return $ret->paginate(config('view.items_per_page'));
    }
}
