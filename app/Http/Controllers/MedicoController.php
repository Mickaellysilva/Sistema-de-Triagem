<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Triagem;

class MedicoController extends Controller
{
    public function index(Request $request)
    {
        // 1. FILA LATERAL: Apenas quem está de fato aguardando o médico chamar
        $fila = Triagem::with('paciente')
            ->where('status', 'aguardando_medico')
            ->orderByRaw("FIELD(classificacao, 'emergencia', 'muito_urgente', 'urgente', 'pouco_urgente', 'nao_urgente') ASC")
            ->orderBy('created_at', 'asc')
            ->get();
        
        $pacientesNaFila = $fila->count();
        
        $atendidosHoje = Triagem::where('status', 'concluido')
            ->whereDate('updated_at', today())
            ->count();

        // 2. PACIENTE ATIVO: Busca quem está em atendimento ativo
        $pacienteSelecionado = Triagem::with('paciente')
            ->where('status', 'em_consulta')
            ->latest('updated_at')
            ->first();
        
        // Se ninguém foi chamado ainda, sugere o primeiro da fila na tela
        if (!$pacienteSelecionado) {
            $pacienteSelecionado = $fila->first();
        }

        return view('medico.dashboard', compact('fila', 'pacientesNaFila', 'atendidosHoje', 'pacienteSelecionado'));
    }

    public function chamarPaciente($id)
    {
        // Limpa chamadas anteriores que ficaram presas por ventura
        Triagem::where('status', 'em_consulta')->update(['status' => 'concluido']);

        $itemFila = Triagem::findOrFail($id);
        
        $itemFila->update([
            'status' => 'em_consulta',
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Paciente chamado no painel com sucesso!');
    }

    public function finalizarConsulta(Request $request, $id)
    {
        $itemFila = Triagem::findOrFail($id);
        
        $itemFila->update([
            'status' => 'concluido',
            'updated_at' => now()
        ]);

        return redirect()->route('medico.index')->with('success', 'Consulta finalizada com sucesso!');
    }
}