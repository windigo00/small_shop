<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    /**
     *
     * @param Request $request
     * @param CustomerRepository $repo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index (Request $request, CustomerRepository $repo) {
        return view('admin.customer.index', [
            'customers'    => $repo->getPage($request)
        ]);
    }
}
