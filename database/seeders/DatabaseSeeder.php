<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@projeto.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // ALUNO
        $alunoUser = User::updateOrCreate(
            ['email' => 'aluno@projeto.com'],
            [
                'name' => 'Aluno Teste',
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'aluno',
                'email_verified_at' => now(),
            ]
        );

        // Registro do aluno (relacionamento)
        Aluno::updateOrCreate(
            ['user_id' => $alunoUser->id],
            [
                'peso' => 70,
                'altura' => 175,
            ]
        );
    }
}
