<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Exibe a view de login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Faz a autenticação do usuário
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário
        $request->authenticate();

        // Regenera a sessão para segurança
        $request->session()->regenerate();

        // Redireciona conforme o tipo de usuário
        return $this->authenticated($request, Auth::user());
    }

    /**
     * Faz logout do usuário
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redireciona o usuário conforme o tipo_usuario
     */
    protected function authenticated(Request $request, $user): RedirectResponse
    {
        // Usa o campo correto: tipo_usuario
        if ($user->tipo_usuario === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->tipo_usuario === 'aluno') {
            return redirect()->route('aluno.dashboard');
        }

        // Caso o tipo não seja reconhecido
        Auth::logout();
        return redirect('/')
            ->withErrors(['tipo' => 'Tipo de usuário inválido.']);
    }
}
