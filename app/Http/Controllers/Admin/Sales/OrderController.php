<?php

namespace App\Http\Controllers\Admin\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index (Request $request, OrderRepository $repo) {
        return view('admin.sales.order.index', [
            'orders'    => $repo->getPage($request)
        ]);
    }
    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function print (Order $order) {
        //print stuff
        return 1;
    }
}
