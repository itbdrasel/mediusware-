<?php

namespace Modules\Core\Http\Middleware;

use Closure;
class AuthxMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//Sentinel::logout();
		//dd(Sentinel::getUser()->hotel_id);

        $auth = \App::make('Modules\Core\Repositories\AuthInterface');

		if ($auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('core/login');
            }
        }
        return $next($request);
    }
}
