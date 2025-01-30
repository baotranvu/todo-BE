<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponse;


class LoginController extends Controller
{
    use ApiResponse;

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->unauthorized('User name or password is incorrect', null);
        }
        if(!auth()->user()->hasVerifiedEmail()) {
            return $this->unauthorized('Please verify your email', null);
        }
        $token = auth()->user()->createToken('api_token')->plainTextToken;
        //init cookie
        $cookie = cookie('api_token', $token, 15, null, null, false, true);
        return $this->successResponse([
                'token' => $token,
                'user' => auth()->user()
        ], 'Login successful')->withCookie($cookie);
    }
}
