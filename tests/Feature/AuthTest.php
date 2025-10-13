<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_consegue_logar()
    {
        $admin = User::factory()->create([
            'tipo_usuario' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin);
    }

    /** @test */
    public function aluno_consegue_logar()
    {
        $aluno = User::factory()->create([
            'tipo_usuario' => 'aluno',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => $aluno->email,
            'password' => '12345678',
        ]);

        $response->assertRedirect('/aluno/dashboard');
        $this->assertAuthenticatedAs($aluno);
    }

    /** @test */
    public function usuario_nao_logado_nao_acessa_rotas_protegidas()
    {
        $response = $this->get('/admin/alunos/index');
        $response->assertRedirect('/login');

        $response = $this->get('/aluno/dashboard');
        $response->assertRedirect('/login');
    }
}
