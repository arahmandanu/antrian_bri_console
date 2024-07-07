<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyJson
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
        if (!$request->wantsJson()) {
            return response()->json([
                'message' => 'Pastikan printer siap digunakan!',
                'error' => true,
            ], 503);
        }

        return $next($request);
    }
}
