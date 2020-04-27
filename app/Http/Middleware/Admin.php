<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Auth\Type;
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
    public function handle($request, Closure $next)
    {
        if (Auth::guard()->user()->authRule->name !== Type::AUTH_TYPE_ADMIN) {
            return Redirect::route('forbidden');
        }
        return $next($request);
    }
}
