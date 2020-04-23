<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     *
     * @param Request $request
     * @param UserRepository $repo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index (Request $request, UserRepository $repo) {
        return view('admin.user.index', [
            'users'    => $repo->getPage($request)
        ]);
    }
}
