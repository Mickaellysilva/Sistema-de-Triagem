<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\FuncionarioController;  
use App\Http\Controllers\TriagemController;

// Tela de login (A que você já criou)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processamento do formulário de login
Route::post('/login', [AuthController::class, 'login']);

// Rota de logout (Útil para depois)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/triagem', [PacienteController::class, 'index'])->name('triagem.index');
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');

// Nova rota para remover da fila
Route::delete('/triagem/{id}', [PacienteController::class, 'destroy'])->name('triagem.destroy');

Route::post('/triagem/adicionar', [PacienteController::class, 'adicionarNaFila'])->name('triagem.adicionar');

Route::get('/dashboard', [PacienteController::class, 'index'])->name('dashboard');

Route::get('/perfil', [FuncionarioController::class, 'perfil'])->name('funcionarios.perfil');

Route::resource('funcionarios', FuncionarioController::class);

Route::resource('triagem', TriagemController::class);