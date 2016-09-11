<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateDokter {


	public function handle($request, Closure $next)
	{
		if (\Auth::guest("dokter"))
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('dokter/login');
			}
		}

		return $next($request);
	}

}
