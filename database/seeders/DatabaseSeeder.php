<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin padrão
        User::updateOrCreate(
            ['email' => 'admin@projeto.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'admin',
            ]
        );

        // Aluno de exemplo (opcional)
        User::updateOrCreate(
            ['email' => 'aluno@projeto.com'],
            [
                'name' => 'Aluno Teste',
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'aluno',
            ]
        );
    }
}
