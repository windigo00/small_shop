<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends AbstractRepository
{
    protected $model_class = User::class;
    public function create(array $modelData = array()): Model {

    }

    public function delete(int $id): void {

    }

    public function update(array $modelData = array()): Model {

    }

    public function getPage(Request $request, array $with = []): LengthAwarePaginator {
        return parent::getPage($request, array_merge(['authRule'], $with));
    }
}
