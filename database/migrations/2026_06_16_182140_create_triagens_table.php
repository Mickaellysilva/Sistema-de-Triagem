<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('triagens', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com a tabela de pacientes
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            
            // Dados clínicos (nullable para permitir que a recepção crie o registro inicial)
            $table->text('sintomas')->nullable();
            $table->string('pressao')->nullable(); // PA
            $table->string('frequencia_cardiaca')->nullable(); // FC
            $table->string('temperatura')->nullable(); // T°
            
            // Nível de urgência do Protocolo de Manchester
            $table->enum('classificacao', [
                'emergencia', 
                'muito_urgente', 
                'urgente', 
                'pouco_urgente', 
                'nao_urgente'
            ])->nullable();
            
            // Status do fluxo de atendimento
            // 'aguardando_triagem' (com enfermeiro), 'aguardando_medico', 'em_atendimento', 'concluido'
            $table->string('status')->default('aguardando_triagem'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagens');
    }
};