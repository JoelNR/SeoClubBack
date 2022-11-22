<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = User::where('email', $request->email)->first();
        
        $token = $user->createToken('seo-token')->plainTextToken;
        
        $request->session()->put('user', 'aaa');
        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'user' => $user,
                'token' => $token,
                'message' => $message,
            ],
        ];

        return response()->json($response, 200);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request): JsonResponse
    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $message = 'All right';
        $response = [
            'data' => [
                'success' => true,
                'message' => $message,
            ],
        ];
        return response()->json($response, 200);
    }
}
