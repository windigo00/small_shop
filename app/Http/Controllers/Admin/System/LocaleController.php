<?php
namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * Description of LocaleController
 *
 * @author windigo
 */
class LocaleController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.system.locale.index');
    }
}
