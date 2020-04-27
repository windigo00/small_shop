<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{
    /**
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        return view('admin.index');
    }
}
