<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Providers\Grid\Container as GridContainer;
use App\Providers\Grid\Column\Model;
use App\Model\Product;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends Controller
{
    /**
     *
     * @param Request $request
     * @param ProductRepository $repo
     * @param \App\Providers\Grid\Column\Model\Product $columns
     * @return Renderable
     */
    public function index(Request $request, ProductRepository $repo, Model\Product $columns): Renderable
    {
        return view('admin.product.index', [
            'product_grid' => app(GridContainer::class, [
                'request'    => $request,
                'repository' => $repo,
                'columns'    => $columns
            ])
        ]);
    }
    /**
     *
     * @param Product $product
     * @return Renderable
     */
    public function edit(Product $product): Renderable
    {
        return view('admin.product.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->update($request->only(['title', 'seo_name', 'price']));

        return redirect('admin/products');
    }
}
