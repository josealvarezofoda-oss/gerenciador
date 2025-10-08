<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'tipo:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/treinos/{aluno}', [AdminController::class, 'indexTreinos'])->name('admin.treinos.index');
    Route::get('/admin/treino/criar/{aluno}', [AdminController::class, 'criarTreinoForm'])->name('admin.treino.criar');
    Route::post('/admin/treino/salvar/{aluno}', [AdminController::class, 'salvarTreino'])->name('admin.treino.salvar');
    Route::get('/admin/treino/editar/{treino}', [AdminController::class, 'editarTreinoForm'])->name('admin.treino.editar');
    Route::put('/admin/treino/atualizar/{treino}', [AdminController::class, 'atualizarTreino'])->name('admin.treino.atualizar');
    Route::delete('/admin/treino/deletar/{treino}', [AdminController::class, 'deletarTreino'])->name('admin.treino.deletar');
});

Route::middleware(['auth', 'tipo:aluno'])->group(function () {
    Route::get('/aluno/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
    Route::get('/aluno/treinos', [AlunoController::class, 'meusTreinos'])->name('aluno.treinos');
});

require __DIR__.'/auth.php';
