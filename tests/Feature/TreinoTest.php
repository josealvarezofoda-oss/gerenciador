<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Treino;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TreinoTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $aluno;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['tipo_usuario' => 'admin']);
        $this->aluno = User::factory()->create(['tipo_usuario' => 'aluno']);
    }

    /** @test */
    public function admin_consegue_criar_treino_e_associar_aluno()
    {
        $data = [
            'nome' => 'Treino Teste',
            'descricao' => 'Descrição treino',
            'alunos' => [$this->aluno->id],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.treino.salvar', $this->aluno->id), $data);

        $response->assertRedirect(route('admin.treino.criar', $this->aluno->id));
        $this->assertDatabaseHas('treinos', ['nome' => 'Treino Teste']);

        $treino = Treino::where('nome', 'Treino Teste')->first();
        $this->assertTrue($treino->alunos->contains($this->aluno));
    }

    /** @test */
    public function aluno_consegue_ver_seus_treinos()
    {
        $treino = Treino::factory()->create();
        $treino->alunos()->attach($this->aluno);

        $response = $this->actingAs($this->aluno)
            ->get(route('aluno.treinos'));

        $response->assertStatus(200);
        $response->assertViewIs('aluno.treinos.index');
        $response->assertSee($treino->nome);
    }

}
