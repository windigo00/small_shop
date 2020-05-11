<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;
use Illuminate\Support\Facades\Auth;
use Modules\Core\SmallShop\Customer\Model\Auth\Type;
use Illuminate\Support\Facades\Redirect;

/**
 * Description of Admin
 *
 * @author windigo
 */
class Admin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
//        debug($request);
        if ($request->has('perPage')) {
            $pp = $request->input('perPage', 10);
            Session::put('items_per_page', $pp == 'All' ? $pp : $pp * 1);
            return redirect()->back();
        }

        if (($pp = Session::get('items_per_page')) !== null) {
            Config::set('view.items_per_page', $pp);
        }

        if (Auth::guard()->user()->authRule->name !== Type::AUTH_TYPE_ADMIN) {
            return Redirect::route('forbidden');
        }
        return $next($request);
    }
}
