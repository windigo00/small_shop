<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Customer;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except([ 'show' ]);
    }

    /**
     * Show the profile for the given user.
     *
     * @param Customer $customer
     * @return type
     */
    public function show(Customer $customer)
    {
        return view('front.profile', ['customer' => $customer]);
    }
    /**
     * Show the profile for the given user.
     *
     * @return type
     */
    public function index(Customer $customer)
    {
        return view('front.profile.index', ['customer' => $customer]);
    }
}
