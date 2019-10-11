<?php

namespace App\Http\Middleware;

use Closure;
use Alert;

class Role
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
        if(auth()->user()->level == 'admin'){
            return $next($request);
        }else{
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect('home');
        }
        
    }
}
