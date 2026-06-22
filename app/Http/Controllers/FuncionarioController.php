<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importação essencial para o delete de fotos

class FuncionarioController extends Controller
{
    /**
     * Exibe a tela de visualização do Perfil do usuário logado.
     */
    public function perfil()
    {
        $funcionario = auth()->user();
       
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

    public function edit(string $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        if ($funcionario->id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar o perfil de outra pessoa.');
        }

        return view('funcionarios.editar', compact('funcionario'));
    }
 
    public function update(Request $request, string $id)
    {
        //
        $funcionario = Funcionario::findOrFail($id);

        if ($funcionario->id !== auth()->id()) {
            abort(403, 'Operação não autorizada.');
        }

        // Adicionado o campo 'telefone' na validação puxando do seu formulário HTML
        $dadosValidados = $request->validate([
            'nome'        => 'required|string|max:255',
            'cpf'         => 'required|string|size:11|unique:funcionarios,cpf,' . $funcionario->id,
            'email'       => 'required|email|max:255|unique:funcionarios,email,' . $funcionario->id,
            'telefone'    => 'nullable|string|max:20', // Validação do número de contato
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto_perfil')) {
            if ($funcionario->foto_perfil) {
                Storage::disk('public')->delete($funcionario->foto_perfil);
            }
            $caminhoFoto = $request->file('foto_perfil')->store('funcionarios', 'public');
            $funcionario->foto_perfil = $caminhoFoto;
        }

        // Atualização dos atributos do modelo
        $funcionario->nome = $dadosValidados['nome'];
        $funcionario->cpf = $dadosValidados['cpf'];
        $funcionario->email = $dadosValidados['email'];
        $funcionario->contato = $dadosValidados['telefone']; // Salva o valor do input 'telefone' na coluna 'contato' do banco
        
        $funcionario->save();

        return redirect()->route('funcionarios.perfil')->with('success', 'Seu perfil foi atualizado com sucesso!');
    }

}