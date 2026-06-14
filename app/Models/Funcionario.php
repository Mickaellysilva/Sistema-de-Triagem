<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'senha',
        'perfil',
        'foto_perfil',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    
    public function isAdministrador(): bool { return $this->perfil === 'Administrador'; }
    public function isRecepcionista(): bool { return $this->perfil === 'Recepcionista'; }
    public function isEnfermeiro(): bool { return $this->perfil === 'Enfermeiro'; }
    public function isMedico(): bool { return $this->perfil === 'Médico'; }
}