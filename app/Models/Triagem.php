<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    protected $table = 'triagens';
    
    protected $fillable = [
        'paciente_id', 
        'sintomas', 
        'pressao', 
        'frequencia_cardiaca', 
        'temperatura', 
        'classificacao', 
        'status'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}