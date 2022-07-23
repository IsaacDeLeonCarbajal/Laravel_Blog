<?php

namespace Database\Factories;

use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'usuario_id' => fake()->randomElement(Usuario::select('id')->pluck('id')),
            'publicacion_id' => fake()->randomElement(Publicacion::select('id')->pluck('id')),
            'contenido' => fake()->text()
        ];
    }
}
