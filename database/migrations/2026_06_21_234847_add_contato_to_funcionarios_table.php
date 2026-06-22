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
        Schema::table('funcionarios', function (Blueprint $table) {
            // Adiciona a coluna 'contato' como opcional (nullable) 
            // e a posiciona logo após o campo 'email'
            $table->string('contato')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            // Se precisarmos desfazer a migration, ela remove a coluna
            $table->dropColumn('contato');
        });
    }
};