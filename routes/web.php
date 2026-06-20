<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\FuncionarioController;  
use App\Http\Controllers\TriagemController;
use Illuminate\Support\Facades\Route;

// Tela de login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processamento do formulário de login
Route::post('/login', [AuthController::class, 'login']);

// Rota de logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas de Triagem e Pacientes (Trabalho do Grupo)
Route::get('/triagem', [PacienteController::class, 'index'])->name('triagem.index');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
Route::delete('/triagem/{id}', [PacienteController::class, 'destroy'])->name('triagem.destroy');
Route::post('/triagem/adicionar', [PacienteController::class, 'adicionarNaFila'])->name('triagem.adicionar');
Route::get('/dashboard', [PacienteController::class, 'index'])->name('dashboard');

// Outros Recursos do Grupo
Route::get('/perfil', [FuncionarioController::class, 'perfil'])->name('funcionarios.perfil');
Stop-Process -Name "php" -Forcefuncionarios', FuncionarioController::class);
Route::resource('triagem', TriagemController::class);

// --- SEU TRABALHO: Rotas do Médico ---
Route::get('/medico', [MedicoController::class, 'index'])->name('medico.index');
Route::post('/medico/finalizar/{id}', [MedicoController::class, 'finalizarConsulta'])->name('medico.finalizar');