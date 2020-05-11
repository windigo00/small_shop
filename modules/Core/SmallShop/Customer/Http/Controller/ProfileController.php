<?php

namespace Modules\Core\SmallShop\Customer\Http\Controller;

use Modules\Core\SmallShop\Customer\Model\Customer;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except([ 'show' ]);
    }

    /**
     * Show the profile for the given user.
     *
     * @param Customer $customer
     * @return View
     */
    public function show(Customer $customer): View
    {
        return view('customer::profile', ['customer' => $customer]);
    }
    /**
     * Show the profile for the given user.
     *
     * @param Customer $customer
     * @return View
     */
    public function index(Customer $customer): View
    {
        return view('customer::profile.index', ['customer' => $customer]);
    }
}
