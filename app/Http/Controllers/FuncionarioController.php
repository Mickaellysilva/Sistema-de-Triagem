<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Exibe a tela de visualização do Perfil do usuário logado.
     */
    public function perfil()
    {
        $funcionario = auth()->user();
        if (!$funcionario) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado.');
        }
        return view('funcionarios.perfil', compact('funcionario'));
    }

    /**
     * Lista os funcionários cadastrados na tela de gestão.
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('Administrador.gestaoFuncionarios', compact('funcionarios'));
    }

    /**
     * Cadastra um novo funcionário de forma segura.
     */
    public function store(Request $request)
    {
        // 1. Validação básica para o Laravel não aceitar campos vazios
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'perfil' => 'required|string',
        ]);

        // 2. O SEGREDO: Impede o erro do banco de dados se o e-mail já existir!
        $usuarioExiste = Funcionario::where('email', $request->email)->exists();
        if ($usuarioExiste) {
            // Em vez de dar tela de erro, ele volta para a página avisando o que houve
            return redirect('/gestaoFuncionarios')->withErrors(['email' => 'Este e-mail já está cadastrado! Tente outro.']);
        }

        // 3. Salva com segurança no banco de dados
        Funcionario::create([
            'nome'    => $request->nome,
            'email'   => $request->email,
            'senha'   => bcrypt($request->input('senha', '123456')),
            'perfil'  => $request->perfil,
            'contato' => $request->contato,
            'cpf'     => $request->input('cpf') ?? '000.000.000-00', 
        ]);

        return redirect('/gestaoFuncionarios')->with('sucesso', 'Funcionário cadastrado com sucesso!');
    }
}