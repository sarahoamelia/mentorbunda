<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateAdmin {


	public function handle($request, Closure $next)
	{
		if (\Auth::guest("admin"))
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('admin/login');
			}
		}

		return $next($request);
	}

}
