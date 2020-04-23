<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Description of Orderable
 *
 * @author windigo
 */
const ORDER_ASCENDENT = 'ASC';
const ORDER_DESCENDENT = 'DESC';
trait Orderable {
    /**
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function order(Builder $query, Request $request): Builder {
        return $query;//->orderBy('order_nr', ORDER_DESCENDENT);
    }
}
