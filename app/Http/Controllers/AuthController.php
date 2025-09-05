<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Interfaces\AuthServiceInterface;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        try {
            return view('pages.auth.login');
        } catch (Exception $e) {
            Log::error('Error login: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman login.');
        }
    }

    public function authenticate(Request $request)
    {
        try {
            // Validasi input
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Cek apakah checkbox remember diisi
            $remember = $request->filled('remember-me');

            // Coba login via service
            if ($this->authService->authenticate($credentials, $remember)) {
                $request->session()->regenerate(); // Hindari session fixation

                return redirect()->intended('/dashboard');
            }

            // Jika gagal login
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput($request->only('email', 'remember'));
        } catch (Exception $e) {
            Log::error('Error login: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat proses login.')->withInput();
        }
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login');
    }
}
