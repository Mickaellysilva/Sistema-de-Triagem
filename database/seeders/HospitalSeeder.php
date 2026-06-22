<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Inserir Funcionários
        DB::table('funcionarios')->insert([
            [
                'nome' => 'João Silva',
                'cpf' => '12345678901',
                'email' => 'enfermeiro@tria.com',
                'senha' => Hash::make('senha123'),
                'perfil' => 'Enfermeiro',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Carlos Oliveira',
                'cpf' => '23456789012',
                'email' => 'medico@tria.com',
                'senha' => Hash::make('senha123'),
                'perfil' => 'Médico',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Maria Souza',
                'cpf' => '34567890123',
                'email' => 'recepcao@tria.com',
                'senha' => Hash::make('senha123'),
                'perfil' => 'Recepcionista',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Vanessa',
                'cpf' => '23456778012',
                'email' => 'administrador@tria.com',
                'senha' => Hash::make('senha123'),
                'perfil' => 'Administrador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. Inserir Pacientes
        DB::table('pacientes')->insert([
            [
                'nome_completo' => 'Clara Bessa',
                'cpf' => '45678901234',
                'data_nascimento' => '1998-04-12',
                'contato' => '88999999991',
                'nome_responsavel' => null,
                'cpf_responsavel' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_completo' => 'Andressa Gomes',
                'cpf' => '56789012345',
                'data_nascimento' => '1995-08-22',
                'contato' => '88999999992',
                'nome_responsavel' => null,
                'cpf_responsavel' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_completo' => 'Gabriela Lucas',
                'cpf' => '67890123456',
                'data_nascimento' => '2001-11-03',
                'contato' => '88999999993',
                'nome_responsavel' => null,
                'cpf_responsavel' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_completo' => 'Ashaley Alcantara',
                'cpf' => '78901234567',
                'data_nascimento' => '2004-01-15',
                'contato' => '88999999994',
                'nome_responsavel' => null,
                'cpf_responsavel' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_completo' => 'Marcos Costa Lima',
                'cpf' => '89012345678',
                'data_nascimento' => '2015-05-20', // Exemplo de menor de idade com responsável
                'contato' => '88999999995',
                'nome_responsavel' => 'Antônio Lima',
                'cpf_responsavel' => '90123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}