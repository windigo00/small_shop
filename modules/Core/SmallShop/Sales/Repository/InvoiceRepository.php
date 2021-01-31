<?php

namespace Modules\Core\SmallShop\Sales\Repository;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\SmallShop\Sales\Model\Invoice;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Providers\Grid\Columns;
use App\Repositories\AbstractRepository;

class InvoiceRepository extends AbstractRepository
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

    public function create(array $modelData = []): Invoice
    {
    }

    public function delete(int $id): void
    {
    }

    public function update(array $modelData = []): Invoice
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
}
