<?php

namespace App\Http\Controllers\Admin\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Model\Order;
use App\Providers\Grid\Container as GridContainer;
use App\Providers\Grid\Column\Model;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
    /**
     *
     * @param Request $request
     * @param OrderRepository $repo
     * @param \App\Providers\Grid\Column\Model\Order $columns
     * @return Renderable
     */
    public function index(Request $request, OrderRepository $repo, Model\Order $columns): Renderable
    {
        return view('admin.sales.order.index', [
            'order_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
    /**
     *
     * @param Order $order
     * @return Response
     */
    public function print(Order $order): Response
    {
        //print stuff
        return response(1);
    }
}
