<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Mostrar formulario de login según el rol
     */
    public function showLoginForm($role)
    {
        // Validar que el role sea válido
        if (!in_array($role, ['administrador', 'caficultor', 'comprador'])) {
            abort(404);
        }
        
        return view('auth.login', compact('role'));
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validar datos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:administrador,caficultor,comprador',
        ]);

        // Mapeo de roles a IDs
        $roleMap = [
            'administrador' => 1,
            'caficultor' => 2,
            'comprador' => 3,
        ];

        // Intentar autenticar
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            // Verificar que el usuario tenga el rol correcto
            if ($user->role_id !== $roleMap[$credentials['role']]) {
                Auth::logout();
                return back()->withErrors(['email' => 'Credenciales incorrectas para este tipo de usuario.']);
            }

            // Verificar que el usuario esté activo (excepto admin)
            if ($user->estado !== 'activo' && !$user->isAdmin()) {
                Auth::logout();
                return back()->withErrors(['email' => 'Tu cuenta está pendiente de aprobación por un administrador.']);
            }

            $request->session()->regenerate();

            // Redirigir según el rol
            return match($credentials['role']) {
                'administrador' => redirect()->route('admin.dashboard'),
                'caficultor' => redirect()->route('caficultor.dashboard'),
                'comprador' => redirect()->route('comprador.dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}