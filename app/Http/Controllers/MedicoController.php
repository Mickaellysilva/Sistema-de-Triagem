<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triagem; // Garante que o Laravel encontre a tabela de triagem do seu grupo

class MedicoController extends Controller
{
    public function index(Request $request)
    {
        // Busca os pacientes na fila puxando os dados de relacionamento
        $fila = Triagem::with('paciente')->orderBy('created_at', 'asc')->get();
        
        $pacientesNaFila = $fila->count();
        $atendidosHoje = 0; // Estatística fictícia para bater com o Figma por enquanto

        // Se o médico clicar em um paciente da fila, pegamos os dados dele
        $pacienteSelecionado = null;
        if ($request->has('atender')) {
            $pacienteSelecionado = Triagem::with('paciente')->find($request->atender);
        }

        return view('medico.dashboard', compact('fila', 'pacientesNaFila', 'atendidosHoje', 'pacienteSelecionado'));
    }

    public function finalizarConsulta(Request $request, $id)
    {
        // Encontra o registro da fila e remove, liberando o paciente
        $itemFila = Triagem::findOrFail($id);
        $itemFila->delete();

        return redirect()->route('medico.index')->with('success', 'Consulta finalizada com sucesso!');
    }
}