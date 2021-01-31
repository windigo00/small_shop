<?php

namespace Modules\Core\SmallShop\User\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\SmallShop\User\Repository\UserRepository;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\User\Provider\Grid\Column\Model;
use Illuminate\Contracts\Support\Renderable;
use Modules\Core\SmallShop\User\Model\User;

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
        return view('user::admin.user.index', [
            'user_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
    
    public function edit(Request $request, User $user): Renderable
    {
        return view('user::admin.user.edit', [
            'user' => $user
        ]);
    }
}
