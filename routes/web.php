<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// rotas admin
Route::middleware(['auth', 'tipo:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // rotas gerenciamento de aluno
    Route::get('/admin/alunos/index', [AdminController::class, 'indexAlunos'])->name('admin.alunos.index');
    Route::post('/admin/alunos', [AdminController::class, 'storeAluno'])->name('admin.alunos.store');
    Route::get('/admin/alunos/create', [AdminController::class, 'createAluno'])->name('admin.alunos.create');
    Route::get('/admin/alunos/{id}/editar', [AdminController::class, 'editAluno'])->name('admin.alunos.editar');
    Route::put('/admin/alunos/{id}', [AdminController::class, 'updateAluno'])->name('admin.alunos.update');


    //rotas gerenciamento de treino
    Route::get('/admin/treinos/index', [AdminController::class, 'indexTreinos'])->name('admin.treinos.index');
    Route::get('/admin/treinos/criar', [AdminController::class, 'criarTreinoForm'])->name('admin.treinos.criar');
    Route::post('/admin/treinos/salvar', [AdminController::class, 'salvarTreino'])->name('admin.treinos.salvar');
    Route::get('/admin/treinos/editar/{id}', [AdminController::class, 'editarTreinoForm'])->name('admin.treinos.editar');
    Route::put('/admin/treinos/atualizar/{id}', [AdminController::class, 'atualizarTreino'])->name('admin.treinos.atualizar');
    Route::delete('/admin/treinos/deletar/{id}', [AdminController::class, 'deletarTreino'])->name('admin.treinos.deletar');
});

// rotas aluno
Route::middleware(['auth', 'tipo:aluno'])->group(function () {
    Route::get('/aluno/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
    Route::get('/aluno/treinos', [AlunoController::class, 'meusTreinos'])->name('aluno.treinos.index');
});

require __DIR__.'/auth.php';
