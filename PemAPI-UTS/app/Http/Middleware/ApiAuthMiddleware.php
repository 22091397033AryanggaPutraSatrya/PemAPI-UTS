<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authenticate = true;

        if (!$token) {
            $authenticate = false;
        }

        $user = User::where('token', $token)->first();

        if (!$user) {
            $authenticate = false;
        } else {
            Auth::login($user);
        }

        if ($authenticate) {
            return $next($request);
        } else {
            return response()->json([
                'errors' => [
                    'message' => 'Unauthorized'
                ]
            ])->setStatusCode(401);
        }
    }
}
