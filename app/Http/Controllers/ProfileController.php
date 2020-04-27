<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Customer;
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
        return view('front.profile', ['customer' => $customer]);
    }
    /**
     * Show the profile for the given user.
     *
     * @param Customer $customer
     * @return View
     */
    public function index(Customer $customer): View
    {
        return view('front.profile.index', ['customer' => $customer]);
    }
}
