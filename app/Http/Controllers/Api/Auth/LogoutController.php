<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    use ApiResponse;
    public function __invoke(Request $request)
    {
        try {
            session()->invalidate();
            $request->user()->currentAccessToken()->delete();
            Auth::guard('web')->logout();
        } catch (\Exception $e) {
            \Log::error('Logout failed: ' . $e->getMessage());
            return $this->error('Failed to process logout request');
        }

        return $this->noContent()->withCookie(cookie()->forget('api_token'));
    }
}
