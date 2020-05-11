<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Catalog\Repository\ProductRepository;

class HomeController extends Controller
{
    /**
     *
     * @var ProductRepository
     */
    protected $repo;


    public function __construct(ProductRepository $repo) {
        $this->repo = $repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('front.welcome', [
            'products' => $this->repo->getPage($request)
        ]);
    }
}
