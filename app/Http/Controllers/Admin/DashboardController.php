<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index (Request $request) {
        return view('admin.index');
    }
}
