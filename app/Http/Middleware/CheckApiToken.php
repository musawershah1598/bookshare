<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class CheckApiToken
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
        if (!empty(trim($request->get('token')))) {
            $token_exists = User::where('id', Auth::guard('api')->id())->exists();
            if ($token_exists) {
                return $next($request);
            } else {
                return response()->json(['error' => "Token not valid"]);
            }
        } else {
            return response()->json(['error' => "Token not provided"]);
        }
    }
}
