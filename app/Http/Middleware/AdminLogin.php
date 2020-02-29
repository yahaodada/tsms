<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        $admin=session('admin');
        if (!$admin){
            return redirect('guanliyuan/create');
        }
        return $next($request);
    }
}
