<?php

namespace App\Http\Middleware;

use App\Models\ResetPass;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->route('token');
        // Kiểm tra token trong bảng ResetPass
        if (!ResetPass::where('token', $token)->exists()) {
            return redirect()->route('getLogin')->with('error', 'Token không hợp lệ hoặc đã hết hạn');
        }
        return $next($request);
    }
}
