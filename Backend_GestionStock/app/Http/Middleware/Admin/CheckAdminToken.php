<?php

namespace App\Http\Middleware\Admin;

use App\Traits\ErrorSeccuss;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use ErrorSeccuss;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        

        $user=null;
        try{
            $user=JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->errorMessage('INVALID TOKEN');
            }elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->errorMessage('EXPIRED TOKEN');
            }
            else{
                return $this->errorMessage('TOKEN NOT FOUND ');
            }
        }
        if (!$user) {
            return $this->errorMessage(trans('Unauthenticated'));
        }
        return $next($request);
    }
}
