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
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica o usuário
        $request->authenticate();

        // Regenera a sessão
        $request->session()->regenerate();

        // Pega o usuário autenticado
        $user = Auth::user();

        // Redireciona conforme tipo
        return $this->authenticated($request, $user);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function authenticated(Request $request, $user): RedirectResponse
    {
        if (!$user) {
            return redirect('/')->withErrors(['login' => 'Usuário não encontrado']);
        }

        if ($user->tipo_usuario === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->tipo_usuario === 'aluno') {
            return redirect()->route('aluno.dashboard');
        }

        Auth::logout();
        return redirect('/')->withErrors(['tipo' => 'Tipo de usuário inválido.']);
    }
}
