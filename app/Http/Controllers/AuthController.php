<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required'],
            'perfil' => ['required', 'in:administrador,recepcionista,enfermeiro,medico']
        ], [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Insira um e-mail válido.',
            'senha.required' => 'A senha é obrigatória.',
            'perfil.required' => 'Selecione um perfil.',
            'perfil.in' => 'Perfil inválido.'
        ]);

        $perfilBanco = ucfirst($credentials['perfil']); 
        $funcionario = Funcionario::where('email', $credentials['email'])->first();

        if ($funcionario && Hash::check($credentials['senha'], $funcionario->senha)) {
            
            if ($funcionario->perfil !== $perfilBanco) {
                return back()->withErrors([
                    'login_error' => 'Este usuário não possui o cargo de ' . $perfilBanco . '.',
                ])->withInput($request->only('email', 'perfil'));
            }

            Auth::login($funcionario);
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login_error' => 'Usuário ou senha inválidos.',
        ])->withInput($request->only('email', 'perfil'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}