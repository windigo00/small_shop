<?php

namespace Modules\Core\SmallShop\Sales\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\SmallShop\Sales\Repository\OrderRepository;
use Modules\Core\SmallShop\Sales\Model\Order;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Renderable;

class OrderController extends Controller
{
    /**
     *
     * @param Request $request
     * @param OrderRepository $repo
     * @param \Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model\Order $columns
     * @return Renderable
     */
    public function index(Request $request, OrderRepository $repo, Model\Order $columns): Renderable
    {
        return view('sales::admin.order.index', [
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
