<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlunoAdminTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['tipo_usuario' => 'admin']);
    }

    /** @test */
    public function admin_consegue_ver_lista_de_alunos()
    {
        $response = $this->actingAs($this->admin)->get('/admin/alunos/index');
        $response->assertStatus(200);
        $response->assertViewIs('admin.alunos.index');
    }

    /** @test */
    public function admin_consegue_criar_aluno()
    {
        $data = [
            'name' => 'Aluno Teste',
            'email' => 'aluno@test.com',
            'idade' => 20,
            'sexo' => 'M',
            'altura' => 1.75,
            'peso' => 70,
        ];

        $response = $this->actingAs($this->admin)->post('/admin/alunos', $data);
        $response->assertRedirect('/admin/alunos/index');
        $this->assertDatabaseHas('users', ['email' => 'aluno@test.com']);
        $this->assertDatabaseHas('alunos', ['idade' => 20]);
    }
}
