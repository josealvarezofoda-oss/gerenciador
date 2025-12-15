<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Mensalidade;
use App\Models\Plano;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AlunoSeeder extends Seeder
{
    public function run()
    {
        $plano = Plano::first();

        if (!$plano) {
            $this->command->error('Nenhum plano encontrado!');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {

            $user = User::create([
                'name' => "Aluno Teste $i",
                'email' => "aluno$i@test.com",
                'password' => Hash::make('12345678'),
                'tipo_usuario' => 'aluno',
            ]);

            $aluno = Aluno::create([
                'user_id' => $user->id,
                'plano_id' => $plano->id,
                'idade' => rand(18, 40),
                'sexo' => rand(0, 1) ? 'M' : 'F',
                'altura' => rand(160, 190) / 100,
                'peso' => rand(55, 95),
                'data_matricula' => now()->subDays(rand(1, 180)),
                'status' => 'ativo',
            ]);

            Mensalidade::create([
                'aluno_id' => $aluno->id,
                'plano_id' => $plano->id,
                'valor' => $plano->valor,
                'status' => rand(0, 1) ? 'pago' : 'pendente',
                'mes_referencia' => Carbon::now()->startOfMonth(),
                'pago_em' => rand(0, 1) ? now()->subDays(rand(1, 10)) : null,
            ]);
        }
    }
}
