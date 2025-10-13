<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aluno_treino', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('treino_id');
            $table->timestamps();

            // Chaves estrangeiras
            $table->foreign('aluno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('treino_id')->references('id')->on('treinos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aluno_treino');
    }
};
