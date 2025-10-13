<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Treino;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treino>
 */
class TreinoFactory extends Factory
{
    protected $model = Treino::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nome' => $this->faker->sentence(2),
            'descricao' => $this->faker->paragraph(),
        ];
    }
}
