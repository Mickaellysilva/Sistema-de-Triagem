<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Tela de login (A que você já criou)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Processamento do formulário de login
Route::post('/login', [AuthController::class, 'login']);

// Rota de logout (Útil para depois)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');