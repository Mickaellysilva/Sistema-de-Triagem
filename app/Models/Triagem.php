<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    protected $table = 'triagens';
    protected $fillable = ['paciente_id', 'status'];

    // Relacionamento: Uma linha da triagem pertence a um Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}