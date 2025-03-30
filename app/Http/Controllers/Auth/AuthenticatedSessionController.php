<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        // $request->session()->regenerate();
        $email = $request['email'];
        $password = $request['password'];

        $params = [
            'grant_type' => 'password',
            'client_id' => config('auth.password_client_id'), /* config('auth.password_client_id) */
            'client_secret' => config('auth.password_client_secret'),    /* config('auth.password_client_secret) */
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ];

        $request = request()->create('oauth/token', 'POST', $params);
        $response = app()->handle($request);
        $response = json_decode($response->getContent(), true);

        // return response()->json($response);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
