<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoriaPublicacion>
 */
class CategoriaPublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'publicacion_id' => fake()->randomElement(Publicacion::select('id')->pluck('id')),
            'categoria_id' => fake()->randomElement(Categoria::select('id')->pluck('id')),
        ];
    }
}
