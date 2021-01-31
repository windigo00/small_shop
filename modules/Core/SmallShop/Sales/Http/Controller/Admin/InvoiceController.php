<?php

namespace Modules\Core\SmallShop\Sales\Http\Controller\Admin;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Sales\Repository\InvoiceRepository;
use App\Providers\Grid\Container as GridContainer;
use Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model;
use Modules\Core\SmallShop\Sales\Model\Invoice;
use Illuminate\Contracts\Support\Renderable;

class InvoiceController extends \App\Http\Controllers\Controller
{
    /**
     *
     * @param Request $request
     * @param InvoiceRepository $repo
     * @param Modules\Core\SmallShop\Sales\Provider\Grid\Column\Model\Invoice $columns
     * @return Renderable
     */
    public function index(Request $request, InvoiceRepository $repo, Model\Invoice $columns): Renderable
    {
        return view('sales::admin.invoice.index', [
            'invoice_grid' => app(GridContainer::class, [
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
        return view('catalog::admin.invoice.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->update($request->only(['title', 'seo_name', 'price']));

        return redirect('admin/invoices');
    }

    public function destroy (Invoice $invoice, Request $request): \Illuminate\Http\RedirectResponse
    {
        $code = 302;
        try {
//            throw new \Exception;
            $invoice->delete();
            $request->session()->flash('success', __('Task was successful!'));
        } catch (\Exception $ex) {
            $code = 500;
            $request->session()->flash('error', __('Task was not successful!'));
        }
        return redirect()->back();
    }
}
