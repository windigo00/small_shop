<?php
use Illuminate\Support\Facades\Route;
use Modules\Core\SmallShop\Catalog\Http\Controller\ProductController;
use Modules\Core\SmallShop\Catalog\Model\Product;
//product detail
Route::get('{product:seo_name}-{pid}', function ($value, $id, ProductController $ctrl) {
    $product = Product::findOrFail(intval($id));
    return $ctrl->show($product);
})->name('product.detail');
