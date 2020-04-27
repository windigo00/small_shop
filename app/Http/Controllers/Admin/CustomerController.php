<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;
use App\Providers\Grid\Container as GridContainer;
use App\Providers\Grid\Column\Model;
use Illuminate\Contracts\Support\Renderable;

class CustomerController extends Controller
{
    /**
     *
     * @param Request $request
     * @param CustomerRepository $repo
     * @param \App\Providers\Grid\Column\Model\Customer $columns
     * @return Renderable
     */
    public function index(Request $request, CustomerRepository $repo, Model\Customer $columns): Renderable
    {
        return view('admin.customer.index', [
            'customer_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
}
