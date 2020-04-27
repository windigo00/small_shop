<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Providers\Grid\Columns;

/**
 * Description of Filterable
 *
 * @author windigo
 */
trait Filterable
{
    /**
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function filter(Builder $query, Request $request, ?Columns $columns = null): Builder
    {
        return $query;//->where('id', '=', 1);
    }
}
