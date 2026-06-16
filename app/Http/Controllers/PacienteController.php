<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PacienteController extends Controller
{
   // Adicione este método ao seu PacienteController.php

public function index(Request $request)
{
    $search = $request->input('busca');
    $searchPaciente = $request->input('busca_paciente'); // Nova busca de já cadastrados

    // Fila de Triagem atual
    $query = Triagem::with('paciente')->where('status', 'aguardando');
    if ($search) {
        $query->whereHas('paciente', function ($q) use ($search) {
            $q->where('nome_completo', 'like', "%{$search}%")
              ->orWhere('cpf', 'like', "%{$search}%");
        });
    }
    $fila = $query->orderBy('created_at', 'asc')->get();

    // Nova Lógica: Buscar pacientes já cadastrados no banco para adicionar à fila
    $resultadosPacientes = [];
    if ($searchPaciente) {
        $resultadosPacientes = Paciente::where('nome_completo', 'like', "%{$searchPaciente}%")
            ->orWhere('cpf', 'like', "%{$searchPaciente}%")
            ->limit(5) // Limita a 5 resultados para não quebrar o layout
            ->get();
    }

    $pacientesNaFila = Triagem::where('status', 'aguardando')->count();
    $totalCadastradosHoje = Paciente::whereDate('created_at', Carbon::today())->count();

    return view('recepcionista', compact('fila', 'pacientesNaFila', 'totalCadastradosHoje', 'search', 'searchPaciente', 'resultadosPacientes'));
}

// Método para colocar o paciente veterano na fila
public function adicionarNaFila(Request $request)
{
    $request->validate([
        'paciente_id' => 'required|exists:pacientes,id'
    ]);

    // Evita duplicar o mesmo paciente na fila se ele já estiver aguardando
    $jaNaFila = Triagem::where('paciente_id', $request->paciente_id)
        ->where('status', 'aguardando')
        ->exists();

    if ($jaNaFila) {
        return redirect()->back()->with('error', 'Este paciente já está aguardando na fila de triagem!');
    }

    Triagem::create([
        'paciente_id' => $request->paciente_id,
        'status' => 'aguardando'
    ]);

    return redirect()->route('dashboard')->with('success', 'Paciente adicionado à fila com sucesso!');
}

    public function store(Request $request)
    {
        // Validação com mensagens customizadas em Português
        $validated = $request->validate([
            'nome_completo'   => 'required|string|max:255',
            'cpf'             => 'nullable|string|digits:11|unique:pacientes,cpf',
            'data_nascimento' => 'required|date|before:today',
            'contato'         => 'string|max:20',
        ], [
            // Mensagens personalizadas para cada regra
            'nome_completo.required'   => 'O campo nome completo é obrigatório.',
            'nome_completo.max'        => 'O nome não pode ter mais que 255 caracteres.',
            
            'cpf.digits'               => 'O CPF deve conter exatamente 11 números.',
            'cpf.unique'               => 'Este CPF já está cadastrado no sistema.',
            
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.date'     => 'Insira uma data válida.',
            'data_nascimento.before'   => 'A data de nascimento deve ser anterior ao dia de hoje.',
            
            'contato.max'              => 'O contato não pode ter mais que 20 caracteres.',
        ]);

        // Cria o paciente
        $paciente = Paciente::create($validated);

        // Insere na fila de triagem
        Triagem::create([
            'paciente_id' => $paciente->id,
            'status'      => 'aguardando'
        ]);

        return redirect()->back()->with('success', 'Paciente cadastrado com sucesso na fila!');
    }

    public function destroy($id)
    {
        $triagem = Triagem::findOrFail($id);
        $triagem->update(['status' => 'removido']);

        return redirect()->back()->with('success', 'Paciente removido da fila com sucesso!');
    }
}