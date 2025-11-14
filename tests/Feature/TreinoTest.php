<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Treino;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TreinoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $aluno;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'tipo_usuario' => 'admin',
        ]);

        $this->aluno = User::factory()->create([
            'tipo_usuario' => 'aluno',
        ]);
    }

    /** @test */
    public function admin_consegue_criar_treino_e_associar_aluno()
    {
        $data = [
            'nome' => 'Treino Teste',
            'descricao' => 'Descrição do treino',
            'alunos' => [$this->aluno->id],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.treinos.salvar'), $data);

        $response->assertRedirect(route('admin.treinos.index'));

        $this->assertDatabaseHas('treinos', [
            'nome' => 'Treino Teste',
        ]);

        $treino = Treino::where('nome', 'Treino Teste')->first();
        $this->assertTrue($treino->alunos->contains($this->aluno));
    }

    /** @test */
    public function aluno_visualiza_apenas_treinos_associados()
    {
        $aluno = User::factory()->create([
            'tipo_usuario' => 'aluno',
        ]);

        $treino1 = Treino::factory()->create([
            'nome' => 'Treino do Aluno',
        ]);
        $aluno->treinos()->attach($treino1->id);

        $treino2 = Treino::factory()->create([
            'nome' => 'Treino de Outro Aluno',
        ]);

        $response = $this->actingAs($aluno)->get(route('aluno.treinos.index'));

        $response->assertStatus(200);
        $response->assertSeeText($treino1->nome);
        $response->assertDontSeeText($treino2->nome);
    }
}
