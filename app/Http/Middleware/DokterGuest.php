<?php
/**
 * Created by PhpStorm.
 * User: rizqy
 * Date: 30/11/2015
 * Time: 16:53
 */

namespace App\Http\Middleware;
use Closure;


class DokterGuest {

    public function handle($request, Closure $next)
    {
        if(\Auth::check('dokter')){
            return redirect('/dokter');
        }

        return $next($request);
    }
}