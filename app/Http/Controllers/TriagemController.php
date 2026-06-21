<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use Illuminate\Http\Request;

class TriagemController extends Controller
{
    /**
     * Tela principal da Triagem (Fila de Espera do Profissional)
     */
    public function index(Request $request)
    {
        $fila = Triagem::with('paciente')
            ->whereIn('status', ['aguardando', 'em_triagem'])
            ->orderBy('created_at', 'asc')
            ->get();

        $pacientesNaFila = Triagem::where('status', 'aguardando')->count();
        $triadosHoje = Triagem::where('status', 'aguardando_medico')->whereDate('updated_at', today())->count();

        $primeiroDaFila = $fila->first();
        $pacienteSelecionado = null;

        if ($primeiroDaFila && $primeiroDaFila->status === 'em_triagem') {
            $pacienteSelecionado = $primeiroDaFila->paciente;
        }

        return view('triagem.painel', compact('fila', 'pacientesNaFila', 'triadosHoje', 'pacienteSelecionado'));
    }

    /**
     * Aciona o primeiro paciente da fila
     */
    public function chamarPaciente($id)
    {
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

  
  
   
   /**
     * Tela da TV / Recepção (Garante o congelamento definitivo no último chamado)
     */
    public function painelTV()
    {
        // 1. Prioridade Máxima: Quem está sendo chamado ATIVAMENTE (clique no botão agora)
        $registro = Triagem::with('paciente')
            ->whereIn('status', ['em_triagem', 'em_consulta'])
            ->orderBy('updated_at', 'desc')
            ->first();

        // 2. Persistência Total: Se ninguém está ativo, congela no ÚLTIMO que sofreu alteração no dia
        // Inclui todos os status para nunca deixar a tela vazia ou voltar para pacientes antigos
        if (!$registro) {
            $registro = Triagem::with('paciente')
                ->whereIn('status', ['em_triagem', 'aguardando_medico', 'em_consulta', 'concluido'])
                ->whereDate('updated_at', today())
                ->orderBy('updated_at', 'desc') // Pega o último que passou pela mão de alguém
                ->first();
        }

        $paciente = null;
        if ($registro && $registro->paciente) {
            
            // REGRA ESTRITA DE DESTINO:
            // SÓ vai para o Consultório Médico se o status for 'em_consulta' ou se já foi 'concluido' vindo do médico.
            // Se o status for 'em_triagem' ou 'aguardando_medico' (esperando o médico), o destino FIXO na tela é a Triagem!
            if ($registro->status === 'em_consulta' || ($registro->status === 'concluido' && $registro->classificacao)) {
                $destino = 'CONSULTÓRIO MÉDICO';
            } else {
                $destino = 'SALA DE TRIAGEM';
            }

            $paciente = [
                'nome'          => $registro->paciente->nome_completo,
                'destino'       => $destino,
                'classificacao' => $registro->classificacao ?? 'triagem'
            ];
        }

        return view('painelChamada', compact('paciente'));
    }
}