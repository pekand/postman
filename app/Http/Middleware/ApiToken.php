<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AccessTokens;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $access_token = $request->header('Authorization');
        $accessToken = AccessTokens::where('access_token', $access_token)->first();

        if($accessToken == null) {
            abort(403, 'Access denied');
        }

        $user = $accessToken->user();

        if($user == null) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
