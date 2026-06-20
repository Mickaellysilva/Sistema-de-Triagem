<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Exibe a tela de visualização do Perfil do usuário logado.
     * Esta é a nova função que criamos para a rota /perfil
     */
    public function perfil()
    {
        // Se você já tiver o sistema de login funcionando, use:
        // $funcionario = auth()->user();

        // Como você está testando o Front-end e o login pode não estar ativo,
        // vamos fixar temporariamente o funcionário ID 1 para a tela não quebrar:
        $funcionario = Funcionario::first() ?? new Funcionario([
            'nome' => 'Funcionário de Teste',
            'cpf' => '00000000000',
            'email' => 'teste@tria.com',
            'perfil' => 'Enfermeiro'
        ]);

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
        return view('funcionarios.editar', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}