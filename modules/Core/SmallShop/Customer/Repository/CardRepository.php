<?php

namespace Modules\Core\SmallShop\Customer\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\SmallShop\Customer\Model\Card;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use Illuminate\Http\Request;
use App\Repositories\AbstractRepository;

class CardRepository extends AbstractRepository
{
    public function __construct(Card $model)
    {
        parent::__construct($model);
    }

    /**
     *
     * @param string[] $modelData
     * @return Model
     */
    public function create(array $modelData = []): Model
    {
        return app(Card::class, $modelData)->create();
    }
    /**
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Card::findOrFail($id)->delete();
    }
    /**
     *
     * @param string[] $modelData
     * @return Model
     */
    public function update(array $modelData = []): Model
    {
        return app(Card::class, $modelData)->create();
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
        return parent::getPage($request, $with, $columns);
    }
}
