<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treino_exercicios', function (Blueprint $table) {
            $table->id();

            //fks Treino
            $table->foreignId('treino_id')
                  ->constrained('treinos')
                  ->onDelete('cascade');

            //fks Exercicio
            $table->foreignId('exercicio_id')
                  ->constrained('exercicios')
                  ->onDelete('cascade');

            $table->integer('series')->nullable();
            $table->integer('repeticoes')->nullable();
            $table->integer('descanso')->nullable();
            $table->integer('ordem')->nullable();
            $table->boolean('concluido')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treino_exercicios');
    }
};
