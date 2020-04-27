<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('front.product', [ 'product' => $product ]);
    }
}
