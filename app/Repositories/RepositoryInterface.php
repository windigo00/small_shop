<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Providers\Grid\Columns;

/**
 * Description of RepositoryInterface
 *
 * @author windigo
 */
interface RepositoryInterface
{
    public function create(array $modelData = []): Model;
    public function update(array $modelData = []): Model;
    public function delete(int $id): void;
    public function getPage(Request $request, array $with = [], ?Columns  $columns = null): LengthAwarePaginator;
}
