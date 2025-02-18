<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckPassword
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
        $token_API = '2oqwLcDssbyvI4OA';
        if ($request->api_password!==env('API_PASSWORD',$token_API)) {
            return response()->json(['message'=>'Unauthenticated to api']);
        }
        return $next($request);
    }
}
