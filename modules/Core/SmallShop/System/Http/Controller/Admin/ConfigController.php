<?php

namespace Modules\Core\SmallShop\System\Http\Controller\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ConfigController extends Controller
{

    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('system::admin.config.index');
    }
}
