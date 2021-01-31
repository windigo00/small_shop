<?php

namespace Modules\Core\SmallShop\Admin\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as ViewContract;

class DashboardController extends Controller
{
    public function index(Request $request): ViewContract
    {
        return view('admin::index');
    }
}
