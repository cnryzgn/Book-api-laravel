<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class isAdmin
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
        $bearerToken = $request->bearerToken();
        $accessToken = PersonalAccessToken::findToken($bearerToken);
        if (!$accessToken) return response()->json([
            'data' => 'Invalid token!'
        ], 404);

        $user = User::Where('id', $accessToken->tokenable_id)->first();
        if (!$user) return response()->json([
            'data' => 'Unauthorized'
        ], 404);

        if ($accessToken && $user->is_admin) {
            return $next($request);
        }

        return response()->json([
            'data' => 'Unauthorized!'
        ], 403);
    }
}
