<?php

namespace App\Http\Controllers;

use App\Models\Triagem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PainelController extends Controller
{
    public function index()
    {
        $chamadaAtiva = Triagem::with('paciente')
            ->whereIn('status', ['em_triagem', 'em_consulta']) 
            ->latest('updated_at') 
            ->first();

        if ($chamadaAtiva) {
            $tempoExibido = Carbon::parse($chamadaAtiva->updated_at)->diffInSeconds(now());

            // Se tiver menos de 10 segundos, força a permanência na tela da TV
            if ($tempoExibido < 10) {
                $paciente = $this->formatarPaciente($chamadaAtiva);
                return view('painelChamada', compact('paciente'));
            }
        }

        $paciente = $chamadaAtiva ? $this->formatarPaciente($chamadaAtiva) : null;
        return view('painelChamada', compact('paciente'));
    }

    private function formatarPaciente($chamadaAtiva)
    {
        if ($chamadaAtiva->status === 'em_triagem') {
            return [
                'nome' => $chamadaAtiva->paciente->nome_completo,
                'destino' => 'TRIAGEM',
                'classe_cor' => 'from-cyan-600 to-sky-700 text-cyan-100 border-cyan-500'
            ];
        } 
        
        $coresManchester = match($chamadaAtiva->classificacao) {
            'emergencia' => 'from-red-600 to-red-800 text-white border-red-500',
            'muito_urgente' => 'from-orange-500 to-orange-700 text-white border-orange-500',
            'urgente' => 'from-amber-400 to-yellow-600 text-slate-900 border-amber-400',
            'pouco_urgente' => 'from-green-600 to-green-800 text-white border-green-500',
            default => 'from-blue-600 to-blue-800 text-white border-blue-500',
        };

        return [
            'nome' => $chamadaAtiva->paciente->nome_completo,
            'destino' => 'CONSULTÓRIO MÉDICO',
            'classe_cor' => $coresManchester
        ];
    }
}