<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\FuncionarioController;  
use App\Http\Controllers\TriagemController;
use Illuminate\Support\Facades\Route;

// ==========================================
// ROTAS PÚBLICAS (Não precisa estar logado)
// ==========================================

// Tela inicial (Painel da TV)
Route::get('/', [TriagemController::class, 'painelTV'])->name('painel.chamada');

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// ROTAS PROTEGIDAS (Só acessa se estiver LOGADO)
// ==========================================
Route::middleware(['auth'])->group(function () {

    // Perfil do Funcionário Logado (Agora vai funcionar!)
    Route::get('/perfil', [FuncionarioController::class, 'perfil'])->name('funcionarios.perfil');

    Route::get('/editar', [FuncionarioController::class, 'perfil'])->name('funcionarios.perfil');

    // Triagem e Pacientes
    Route::get('/triagem', [PacienteController::class, 'index'])->name('triagem.index');
    Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
    Route::delete('/triagem/{id}', [PacienteController::class, 'destroy'])->name('triagem.destroy');
    Route::post('/triagem/adicionar', [PacienteController::class, 'adicionarNaFila'])->name('triagem.adicionar');
    Route::post('/triagem/chamar/{id}', [TriagemController::class, 'chamarPaciente'])->name('triagem.chamar');
    
    Route::get('/recepcionista', [PacienteController::class, 'index'])->name('recepcionista');
    
    // Resources
    Route::resource('funcionarios', FuncionarioController::class);
    Route::resource('triagem', TriagemController::class);

    // Rotas do Médico
    Route::get('/medico', [MedicoController::class, 'index'])->name('medico.index');
    Route::post('/medico/finalizar/{id}', [MedicoController::class, 'finalizarConsulta'])->name('medico.finalizar');
    Route::post('/medico/chamar/{id}', [MedicoController::class, 'chamarPaciente'])->name('medico.chamar');

    // Gestão de Funcionários - ADMIN
    Route::get('/gestaoFuncionarios', [FuncionarioController::class, 'index'])->name('admin');
    Route::post('/gestaoFuncionarios', [FuncionarioController::class, 'store']);

});