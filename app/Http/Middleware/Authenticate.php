<?php

namespace App\Http\Middleware;
// use Illuminate\Http\Request;
use Request;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // dd(Request::is('admin/*'));
            if (Request::is('admin/*') || Request::is('admin')){
                // dd(Request::all() );
                return route('get.admin.login');
            }
            else{
                return route('login');
            }
        }
    }
}
