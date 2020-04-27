<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Providers\Grid\Container as GridContainer;
use App\Providers\Grid\Column\Model;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    /**
     *
     * @param Request $request
     * @param UserRepository $repo
     * @return Renderable
     */
    public function index(Request $request, UserRepository $repo, Model\User $columns): Renderable
    {
        return view('admin.user.index', [
            'user_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
}
