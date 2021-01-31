<?php

namespace Modules\Core\SmallShop\Business\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\Business\Provider\Grid\Column\Model;
use Illuminate\Contracts\Support\Renderable;
use Modules\Core\SmallShop\Business\Repository\ContractorRepository;
use Illuminate\Support\Facades\DB;

class ContractorController extends \App\Http\Controllers\Controller
{
    public function index(Request $request, ContractorRepository $repo, Model\Contractor $columns): Renderable
    {
        return view('business::admin.task.contract.contractors.index', [
            'contractor_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }

    public function show(?int $customer_id, Request $request): Renderable
    {
        return view();
    }

    public function list(?int $current, Request $request): \Illuminate\Http\JsonResponse
    {

        return response()->json(['data' => $days]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
    }
}
