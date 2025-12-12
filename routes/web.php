<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Controllers Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlunoAdminController;
use App\Http\Controllers\Admin\TreinoController;
use App\Http\Controllers\Admin\ExercicioController;
use App\Http\Controllers\TreinoExercicioController;

// Controller do Aluno
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Rotas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas Admin
Route::prefix('admin')->middleware(['auth', 'tipo:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Alunos
    Route::get('/alunos', [AlunoAdminController::class, 'indexAlunos'])->name('admin.alunos.index');
    Route::get('/alunos/create', [AlunoAdminController::class, 'createAluno'])->name('admin.alunos.create');
    Route::post('/alunos', [AlunoAdminController::class, 'storeAluno'])->name('admin.alunos.store');
    Route::get('/alunos/{id}/editar', [AlunoAdminController::class, 'editAluno'])->name('admin.alunos.editar');
    Route::put('/alunos/{id}', [AlunoAdminController::class, 'updateAluno'])->name('admin.alunos.update');
    Route::put('/alunos/{id}/status', [AlunoAdminController::class, 'toggleAlunoStatus'])->name('admin.alunos.status');

    // CRUD Treinos
    Route::get('/treinos', [TreinoController::class, 'index'])->name('admin.treinos.index');
    Route::get('/treinos/criar', [TreinoController::class, 'create'])->name('admin.treinos.criar');
    Route::post('/treinos', [TreinoController::class, 'store'])->name('admin.treinos.store');
    Route::get('/treinos/{id}/editar', [TreinoController::class, 'edit'])->name('admin.treinos.editar');
    Route::put('/treinos/{id}', [TreinoController::class, 'update'])->name('admin.treinos.atualizar');
    Route::delete('/treinos/{id}', [TreinoController::class, 'destroy'])->name('admin.treinos.delete');

    // CRUD Exercícios
    Route::get('/exercicios', [ExercicioController::class, 'index'])->name('admin.exercicios.index');
    Route::get('/exercicios/create', [ExercicioController::class, 'create'])->name('admin.exercicios.create');
    Route::post('/exercicios', [ExercicioController::class, 'store'])->name('admin.exercicios.store');
    Route::get('/exercicios/{id}/editar', [ExercicioController::class, 'edit'])->name('admin.exercicios.editar');
    Route::put('/exercicios/{id}', [ExercicioController::class, 'update'])->name('admin.exercicios.update');
    Route::delete('/exercicios/{id}', [ExercicioController::class, 'destroy'])->name('admin.exercicios.deletar');
});

// Rotas Aluno
Route::prefix('aluno')->middleware(['auth', 'tipo:aluno'])->group(function () {
    Route::get('/dashboard', [AlunoController::class, 'dashboard'])->name('aluno.dashboard');
    Route::get('/treinos', [AlunoController::class, 'meusTreinos'])->name('aluno.treinos.index');
    Route::put('/treinos/{id}/concluir', [TreinoExercicioController::class, 'concluir'])->name('aluno.treinos.concluir');
});

require __DIR__.'/auth.php';
