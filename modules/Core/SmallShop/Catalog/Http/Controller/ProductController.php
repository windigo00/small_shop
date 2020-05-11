<?php

namespace Modules\Core\SmallShop\Catalog\Http\Controller;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Catalog\Model\Product;
use Illuminate\View\View;

class ProductController extends \App\Http\Controllers\Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('catalog::product.detail', [ 'product' => $product ]);
    }
}
