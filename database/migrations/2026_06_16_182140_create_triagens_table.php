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
            // Cria o relacionamento com a sua tabela de pacientes
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            
            // Status: 'aguardando', 'em_atendimento', 'concluido', 'removido'
            $table->string('status')->default('aguardando'); 
            
            $table->timestamps(); // O 'created_at' será o nosso horário de entrada na fila
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
