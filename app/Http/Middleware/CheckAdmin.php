<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('client.index')->with('error', 'Bạn không có quyền truy cập !');
        }
        if (Auth::check()) {
            if (Auth::user()->role_id == 3 ) {
                return redirect()->route('client.index')->with('error', 'Bạn không có quyền truy cập !');
            }
        }
        return $next($request);
    }
}
