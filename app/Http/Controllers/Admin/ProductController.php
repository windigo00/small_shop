<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     *
     * @param Request $request
     * @param ProductRepository $repo
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index (Request $request, ProductRepository $repo) {

        return view('admin.product.index', [
            'products'    => $repo->getPage($request)
        ]);
    }
}
