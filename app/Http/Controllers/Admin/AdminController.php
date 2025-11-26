<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Treino;

class AdminController extends Controller
{
    public function index()
    {
        $totalAlunos = Aluno::count();
        $totalTreinos = Treino::count();
        
        return view('admin.dashboard', compact('totalAlunos', 'totalTreinos'));
    }
}
