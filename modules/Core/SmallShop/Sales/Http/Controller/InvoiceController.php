<?php

namespace Modules\Core\SmallShop\Sales\Http\Controller;

use Illuminate\Http\Request;
use Modules\Core\SmallShop\Sales\Model\Invoice;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class InvoiceController extends \App\Http\Controllers\Controller
{
    /**
     * Show the profile for the given user.
     */
    public function show(Invoice $item): View
    {
        return view('sales::invoice.index', [ 'item' => $item ]);
    }
}
