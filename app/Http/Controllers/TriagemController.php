<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use Illuminate\Http\Request;

class TriagemController extends Controller
{
    /**
     * Tela principal da Triagem (Fila de Espera)
     */
    public function index(Request $request)
    {
        // Pega todos os registros aguardando ou em atendimento na triagem, do mais antigo para o mais recente
        $fila = Triagem::with('paciente')
            ->whereIn('status', ['aguardando', 'em_triagem'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Contadores fixos para o painel superior
        $pacientesNaFila = Triagem::where('status', 'aguardando')->count();
        $triadosHoje = Triagem::where('status', 'aguardando_medico')->whereDate('updated_at', today())->count();

        // Verifica se o primeiro da fila já está com status 'em_triagem' (ativado pelo botão de chamada)
        $primeiroDaFila = $fila->first();
        $pacienteSelecionado = null;

        if ($primeiroDaFila && $primeiroDaFila->status === 'em_triagem') {
            $pacienteSelecionado = $primeiroDaFila->paciente;
        }

        return view('triagem.painel', compact('fila', 'pacientesNaFila', 'triadosHoje', 'pacienteSelecionado'));
    }

    /**
     * Aciona o primeiro paciente da fila (Gatilho idêntico ao do médico)
     */
    public function chamarPaciente($id)
    {
        // Garante que estamos chamando o registro correto e muda o status para a TV e formulário
        $triagem = Triagem::where('id', $id)->where('status', 'aguardando')->firstOrFail();
        
        $triagem->update([
            'status' => 'em_triagem',
            'updated_at' => now()
        ]);

        return redirect()->route('triagem.index')->with('success', 'Paciente chamado no painel!');
    }

    /**
     * Salva os dados clínicos e muda o status para a fila do Médico
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'paciente_id'         => ['required', 'exists:pacientes,id'],
            'sintomas'            => ['required', 'string'],
            'pressao'             => ['required', 'string'],
            'frequencia_cardiaca' => ['required', 'string'],
            'temperatura'         => ['required', 'string'],
            'classificacao'       => ['required', 'in:emergencia,muito_urgente,urgente,pouco_urgente,nao_urgente'],
        ]);

        $triagem = Triagem::where('paciente_id', $request->paciente_id)
                          ->where('status', 'em_triagem')
                          ->first();

        if ($triagem) {
            $triagem->update([
                'sintomas'            => $dados['sintomas'],
                'pressao'             => $dados['pressao'],
                'frequencia_cardiaca' => $dados['frequencia_cardiaca'],
                'temperatura'         => $dados['temperatura'],
                'classificacao'       => $dados['classificacao'],
                'status'              => 'aguardando_medico',
                'updated_at'          => now()
            ]);
        }

        return redirect()->route('triagem.index')
                         ->with('success', 'Triagem concluída! Paciente enviado para a fila do médico.');
    }
}