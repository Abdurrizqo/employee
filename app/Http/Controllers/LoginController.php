<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function superAdminloginPage()
    {
        return view("SuperAdmin/superAdminLogin");
    }

    public function handleLoginSuperAdmin(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('guard_super_admin')->attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->intended('super-admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ])->withInput($request->only('username'));
    }

    public function adminloginPage()
    {
        return view("Admin/adminLogin");
    }

    public function handleLoginAdmin(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('guard_admin')->attempt($validate)) {
            if (Auth::guard('guard_admin')->user()->is_active) {
                return back()->withErrors([
                    'username' => 'Akun Di nonaktifkan.',
                ])->withInput($request->only('username'));
            }

            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ])->withInput($request->only('username'));
    }

    public function userloginPage()
    {
        return view("User/userLogin");
    }

    public function handleLoginUser(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('guard_user')->attempt($validate)) {
            if (Auth::guard('guard_user')->user()->is_active) {
                return back()->withErrors([
                    'username' => 'Akun Di nonaktifkan.',
                ])->withInput($request->only('username'));
            }

            $request->session()->regenerate();

            if (Auth::guard('guard_user')->user()->is_open) {
                return redirect()->intended('dashboard');
            }
            return redirect()->intended('user-konfigurasi');
        }

        return back()->withErrors([
            'username' => 'Username atau Password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        // Guard mapping for redirection
        $guardRedirects = [
            'guard_super_admin' => '/super-admin-login',
            'guard_admin' => '/admin-login',
            'guard_user' => '/',
        ];

        // Detect the current guard
        $currentGuard = null;
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (Auth::guard($guard)->check()) {
                $currentGuard = $guard;
                break;
            }
        }

        // Logout the user from the detected guard
        if ($currentGuard) {
            Auth::guard($currentGuard)->logout();
        }

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the appropriate login page
        return redirect($guardRedirects[$currentGuard] ?? '/')->with('success', 'Anda telah berhasil logout.');
    }
}
