<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('plano_id');
            $table->date('mes_referencia');
            $table->decimal('valor', 8, 2);
            $table->enum('status', ['pendente', 'pago', 'atrasado']);
            $table->date('pago_em')->nullable();
            $table->timestamps();

            // FK
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('plano_id')->references('id')->on('planos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensalidades');
    }
};
