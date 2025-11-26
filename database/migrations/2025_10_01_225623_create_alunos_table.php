<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->integer('idade')->nullable();
            $table->string('sexo')->nullable();
            $table->date('data_matricula')->nullable();
            $table->decimal('altura', 5, 2)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('imc', 5, 2)->nullable();
            $table->enum('status', ['ativo', 'pendente'])->default('pendente');

            //fks
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');            
            $table->foreignId('plano_id')->nullable()->constrained('planos');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
