<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function authenticate(array $credentials, bool $remember = false)
    {
        try {
            return Auth::attempt($credentials, $remember);
        } catch (Exception $e) {
            Log::error('Error during login attempt: ' . $e->getMessage());
            return false;
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
        } catch (Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage());
            throw $e;
        }
    }
}
