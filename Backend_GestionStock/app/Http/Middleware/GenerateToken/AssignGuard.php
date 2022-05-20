<?php

namespace App\Http\Middleware\GenerateToken;

use App\Traits\ErrorSeccuss;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Tymon\JWTAuth\Facades\JWTAuth;

class AssignGuard
{ 
    use ErrorSeccuss;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard=null)
    {   
        if ($guard!=null) {
            auth()->shouldUse($guard);
        }
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
