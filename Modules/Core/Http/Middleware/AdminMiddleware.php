<?php

namespace Modules\Core\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;

class AdminMiddleware
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
		$auth = \App::make('Modules\Core\Repositories\AuthInterface');

		if($auth->check()){
			if( Route::currentRouteName() ){
				if($auth->hasAccess(Route::currentRouteName())){
					return $next($request);
				}else{
					die('You are not permitted to access here!');
				}

			}else{
				die('No route name found for this request.');
			}
        }else{
            return redirect('/');
        }


    }
}
