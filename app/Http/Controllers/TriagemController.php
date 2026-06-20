<?php

namespace App\Http\Controllers;

use App\Models\Paciente; 
use App\Models\Triagem;
use Illuminate\Http\Request;

class TriagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pacientes = Paciente::query()->paginate(10);

        $pacienteSelecionado = null;
        if ($request->has('paciente_id')) {
            $pacienteSelecionado = Paciente::query()->find($request->paciente_id);
        }

        return view('triagem.painel', compact('pacientes', 'pacienteSelecionado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Triagem::create($request->validated());

        return redirect()->route('triagem.index')
                         ->with('success', 'Triagem realizada com sucesso!');
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
        //
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