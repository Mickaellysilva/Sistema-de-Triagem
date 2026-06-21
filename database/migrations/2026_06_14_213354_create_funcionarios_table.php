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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            
            $table->string('cpf', 11)->unique(); 
            $table->string('email')->unique();

            
            $table->string('senha'); 
            
            $table->enum('perfil', ['Administrador', 'Recepcionista', 'Enfermeiro', 'Médico']); 
            
            $table->string('foto_perfil')->nullable(); 
            
            
            $table->timestamps();
            
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};