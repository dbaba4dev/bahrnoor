<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (!Auth::user()->admin)
        {
            $notification = array(
                'message' => 'You do not have permissions to perform this action.',
                'alert-type' => 'info'
            );

            return redirect()->back()->with($notification);
        }
        return $next($request);
    }
}
