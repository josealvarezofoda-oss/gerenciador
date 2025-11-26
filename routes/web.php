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

// Controller do aluno
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//rotas Admin
Route::middleware(['auth', 'tipo:admin'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');
    //crud Aluno
    Route::get('/admin/alunos', [AlunoAdminController::class, 'indexAlunos'])
        ->name('admin.alunos.index');
    Route::get('/admin/alunos/create', [AlunoAdminController::class, 'createAluno'])
        ->name('admin.alunos.create');
    Route::post('/admin/alunos', [AlunoAdminController::class, 'storeAluno'])
        ->name('admin.alunos.store');
    Route::get('/admin/alunos/{id}/editar', [AlunoAdminController::class, 'editAluno'])
        ->name('admin.alunos.editar');
    Route::put('/admin/alunos/{id}', [AlunoAdminController::class, 'updateAluno'])
        ->name('admin.alunos.update');
    Route::put('/admin/alunos/{id}/status', [AlunoAdminController::class, 'toggleAlunoStatus'])
        ->name('admin.alunos.status');
    //crud treinos
    Route::get('/admin/treinos', [TreinoController::class, 'index'])
        ->name('admin.treinos.index');
    Route::get('/admin/treinos/criar', [TreinoController::class, 'create'])
        ->name('admin.treinos.criar');
    Route::post('/admin/treinos', [TreinoController::class, 'store'])
        ->name('admin.treinos.store');
    Route::get('/admin/treinos/{id}/editar', [TreinoController::class, 'edit'])
        ->name('admin.treinos.editar');
    Route::put('/admin/treinos/{id}', [TreinoController::class, 'update'])
        ->name('admin.treinos.atualizar');
    Route::delete('/admin/treinos/{id}', [TreinoController::class, 'destroy'])
        ->name('admin.treinos.delete');
    //crud exercicios
    Route::get('/admin/exercicios', [ExercicioController::class, 'index'])
        ->name('admin.exercicios.index');
    Route::get('/admin/exercicios/create', [ExercicioController::class, 'create'])
        ->name('admin.exercicios.create');
    Route::post('/admin/exercicios', [ExercicioController::class, 'store'])
        ->name('admin.exercicios.store');
    Route::get('/admin/exercicios/{id}/editar', [ExercicioController::class, 'edit'])
        ->name('admin.exercicios.editar');
    Route::put('/admin/exercicios/{id}', [ExercicioController::class, 'update'])
        ->name('admin.exercicios.update');
    Route::delete('/admin/exercicios/{id}', [ExercicioController::class, 'destroy'])
        ->name('admin.exercicios.deletar');
});

//rotas Aluno
Route::middleware(['auth', 'tipo:aluno'])->group(function () {
    Route::get('/aluno/dashboard', [AlunoController::class, 'dashboard'])
        ->name('aluno.dashboard');
    Route::get('/aluno/treinos', [AlunoController::class, 'meusTreinos'])
        ->name('aluno.treinos.index');
    Route::put('/aluno/treinos/{id}/concluir', [TreinoExercicioController::class, 'concluir'])
        ->name('aluno.treinos.concluir');
});


require __DIR__.'/auth.php';
