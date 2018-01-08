<?php namespace Satudata\Hargaberlaku\Http\Middleware;

use Closure;

/**
 * The HargaberlakuMiddleware class.
 *
 * @package Satudata\Hargaberlaku
 * @author  mki <info@mkitech.net>
 */
class HargaberlakuMiddleware
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
        return $next($request);
    }
}
