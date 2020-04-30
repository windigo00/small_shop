<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ConfigController extends Controller
{

    public function setLocale(string $locale) {

        Session::put('locale', $locale);
        return redirect(url(URL::previous()));
    }
}
