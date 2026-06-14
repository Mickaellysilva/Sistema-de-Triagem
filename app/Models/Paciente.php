<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'nome_completo',
        'cpf',
        'data_nascimento',
        'contato',
        'nome_responsavel',
        'cpf_responsavel'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}