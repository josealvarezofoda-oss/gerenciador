<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'tipo:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/treinos/{aluno}', [AdminController::class, 'indexTreinos'])->name('admin.treinos.index');
    Route::get('/admin/treinos/criar/{aluno}', [AdminController::class, 'criarTreinoForm'])->name('admin.treinos.criar');
    Route::post('/admin/treinos/salvar/{aluno}', [AdminController::class, 'salvarTreino'])->name('admin.treinos.salvar');
    Route::get('/admin/treinos/editar/{treinos}', [AdminController::class, 'editarTreinoForm'])->name('admin.treinos.editar');
    Route::put('/admin/treinos/atualizar/{treinos}', [AdminController::class, 'atualizarTreino'])->name('admin.treinos.atualizar');
    Route::delete('/admin/treinos/deletar/{treinos}', [AdminController::class, 'deletarTreino'])->name('admin.treinos.deletar');
});

Route::middleware(['auth', 'checkTipoUsuario:admin'])->group(function () {
    Route::get('/admin/alunos/index', [AdminController::class, 'indexAlunos'])->name('admin.alunos.index');
    Route::get('/admin/alunos/create', [AdminController::class, 'createAluno'])->name('admin.alunos.create');
    Route::get('/admin/alunos/store', [AdminController::class, 'storeAluno'])->name('admin.alunos.store');
});


Route::middleware(['auth', 'tipo:aluno'])->group(function () {
    Route::get('/aluno/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
    Route::get('/aluno/treinos', [AlunoController::class, 'meusTreinos'])->name('aluno.treinos');
});

require __DIR__.'/auth.php';
