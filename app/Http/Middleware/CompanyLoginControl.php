<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\firmalar;

class CompanyLoginControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!isset($_COOKIE["FirmaID"]) || !firmalar::where("FirmaID",$_COOKIE["FirmaID"])->first())
            return redirect('/firma/giris-yap');
        return $next($request);
    }
}
