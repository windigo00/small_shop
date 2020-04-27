<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Providers\Grid\Columns;
use App\Providers\Grid\Column;
use Illuminate\Support\Facades\DB;

/**
 * Description of Orderable
 *
 * @author windigo
 */
const ORDER_ASCENDENT = 'ASC';
const ORDER_DESCENDENT = 'DESC';
trait Orderable
{
    /**
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function order(Builder $query, Request $request, ?Columns $columns = null): Builder
    {
        $sort = $request->input(config('view.sort_attribute'));

        if (is_array($sort) && !empty($sort)) {
            foreach ($sort as $name => $order) {
                /* @var $column Column */
                if ($columns) {
                    $column = $columns->getColumn($name);
                }
                if ($column && $column->getOrderColumn()) {// add relation
                    try {
                        $query = $this->resolveRelationQuery($query, $request, $name, $order, $column->getOrderColumn());
                    } catch (\BadMethodCallException $e) {
                        $query->orderBy(DB::raw($column->getOrderColumn()), $order);
                    }
                } else {
                    $query->orderBy($name, $order);
                }
            }
        }
//        dump($query->toSql());
        return $query;
    }
    /**
     *
     * @param Builder $query
     * @param Request $request
     * @param string $name
     * @param string $order
     * @param string $order_exp
     *
     * @throws \BadMethodCallException
     *
     * @return Builder
     */
    protected function resolveRelationQuery(Builder $query, Request $request, string $name, string $order, string $order_exp): Builder
    {
        $relation = $name;
        $column = $order_exp;
        /* @var $rel Relation */
        $rel = $query->getModel()->$relation();
        /* @var $parent Model */
        $parent = $rel->getParent();
        /* @var $related Model */
        $related = $rel->getRelated();
        switch (get_class($rel)) {
            case BelongsTo::class:
                /* @var $rel BelongsTo */
                $query->leftJoin($related->getTable(), $rel->getQualifiedOwnerKeyName(), '=', $rel->getQualifiedForeignKeyName());
                break;
            case HasOne::class:
                /* @var $rel HasOne */
                $query->leftJoin($related->getTable(), $rel->getQualifiedParentKeyName(), '=', $rel->getQualifiedForeignKeyName());
                break;
            case HasOneThrough::class:
                /* @var $rel HasOneThrough */
                $query->leftJoin($parent->getTable(), $rel->getQualifiedLocalKeyName(), '=', $rel->getQualifiedFirstKeyName());
                $query->leftJoin($related->getTable(), $rel->getQualifiedParentKeyName(), '=', $rel->getQualifiedForeignKeyName());
                break;
        }
        $query->orderBy(DB::raw(str_replace($name.'.', $related->getTable().'.', $column)), $order);
        return $query;
    }
}
