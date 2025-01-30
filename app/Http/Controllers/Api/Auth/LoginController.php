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
        //create token
        $token = auth()->user()->createToken(auth()->user()->email, ['*'], now()->addMinutes(intval(env('SANCTUM_EXPIRATION', 15))))->plainTextToken;
        //session
        session()->regenerate();
        session()->put('token', $token);
        //init cookie
        $cookie = cookie('api_token', $token, env('SANCTUM_EXPIRATION', 15), null, null, false, true);
        return $this->successResponse([
                'token' => $token,
                'user' => auth()->user()
        ], 'Login successful')->withCookie($cookie);
    }
}
