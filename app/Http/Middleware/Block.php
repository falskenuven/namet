<?php

namespace App\Http\Middleware;

use Closure;

class Block
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
        $now =  date('Y-m-d');
        $user = $request->user();
        $date = false;

        if($user->disabled != null) {
            $date = $user->disabled;
        }

        if($date && $date > $now) {
            return redirect('home');
        }

        return $next($request);
    }
}
