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

        if (!$funcionario) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado.');
        }

        return view('funcionarios.perfil', compact('funcionario'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        if ($funcionario->id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar o perfil de outra pessoa.');
        }

        return view('funcionarios.editar', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}