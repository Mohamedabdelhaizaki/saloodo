<?php

namespace App\Http\Middleware;

use App\Helpers\API;
use Closure;
use Illuminate\Http\Request;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->user_type == 1 &&  auth()->user()->is_active === 1) {
            return $next($request);
        }

        if (!$request->wantsJson()) {
            return redirect()->route('login')->withError('Please Login');
        }

        return (new API())->setMessage(__('We are sorry but something went wrong. please try to log in again'))
            ->setStatusUnauthorized()
            ->build();
    }
}
