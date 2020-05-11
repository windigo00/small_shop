<?php

namespace Modules\Core\SmallShop\Catalog\Http\Controller\Admin;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Catalog\Repository\ProductRepository;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\Catalog\Provider\Grid\Column\Model;
use Modules\Core\SmallShop\Catalog\Model\Product;
use Illuminate\Contracts\Support\Renderable;

class ProductController extends \App\Http\Controllers\Controller
{
    /**
     *
     * @param Request $request
     * @param ProductRepository $repo
     * @param Modules\Core\SmallShop\Catalog\Provider\Grid\Column\Model $columns
     * @return Renderable
     */
    public function index(Request $request, ProductRepository $repo, Model\Product $columns): Renderable
    {
        return view('catalog::admin.product.index', [
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
        return view('catalog::admin.product.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->update($request->only(['title', 'seo_name', 'price']));

        return redirect('admin/products');
    }

    public function destroy (Product $product, Request $request): \Illuminate\Http\RedirectResponse
    {
        $code = 302;
        try {
//            throw new \Exception;
            $product->delete();
            $request->session()->flash('success', __('Task was successful!'));
        } catch (\Exception $ex) {
            $code = 500;
            $request->session()->flash('error', __('Task was not successful!'));
        }
        return redirect()->back();
    }
}
