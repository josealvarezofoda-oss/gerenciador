<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aluno;
use App\Models\Mensalidade;
use Carbon\Carbon;

class GerarMensalidades extends Command
{
    protected $signature = 'app:gerar-mensalidades';

    protected $description = 'Gera mensalidades do mês atual para todos os alunos ativos';

    public function handle()
    {
        $mesReferencia = Carbon::now()->startOfMonth();

        // SOMENTE alunos ativos
        $alunos = Aluno::with(['plano', 'user'])
            ->where('status', 'ativo')
            ->get();

        $this->info('Gerando mensalidades de ' . $mesReferencia->format('m/Y'));
        $count = 0;

        foreach ($alunos as $aluno) {

            if (!$aluno->plano) {
                $this->warn("Aluno ID {$aluno->id} não possui plano. Ignorado.");
                continue;
            }

            $mensalidade = Mensalidade::firstOrCreate(
                [
                    'aluno_id' => $aluno->id,
                    'mes_referencia' => $mesReferencia, // ✅ campo correto
                ],
                [
                    'plano_id' => $aluno->plano->id,
                    'valor' => $aluno->plano->valor,
                    'status' => 'pendente',
                ]
            );

            if ($mensalidade->wasRecentlyCreated) {
                $count++;
                $this->info("Mensalidade criada para {$aluno->user->name}");
            }
        }

        $this->info("Processo finalizado! {$count} mensalidades criadas.");

        return Command::SUCCESS;
    }
}
