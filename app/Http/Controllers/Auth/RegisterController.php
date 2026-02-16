<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Mostrar formulario de registro según el rol
     */
    public function showRegistrationForm($role)
    {
        if (!in_array($role, ['caficultor', 'comprador'])) {
            abort(404);
        }
        
        return view('auth.register', compact('role'));
    }

    /**
     * Procesar el registro
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'required|string|max:20',
            'documento' => 'required|string|unique:users',
            'role' => 'required|in:caficultor,comprador',
        ]);

        $roleMap = ['caficultor' => 2, 'comprador' => 3];

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'telefono' => $validated['telefono'],
            'documento' => $validated['documento'],
            'role_id' => $roleMap[$validated['role']],
            'estado' => 'pendiente',
        ]);

        return redirect()->route('login.form', ['role' => $validated['role']])
            ->with('success', 'Registro exitoso. Tu cuenta está pendiente de aprobación por un administrador.');
    }
}