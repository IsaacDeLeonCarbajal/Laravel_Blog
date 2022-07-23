<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\CategoriaPublicacion;
use App\Models\Comentario;
use App\Models\Publicacion;
use App\Models\Usuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Usuario::factory(40)->create();
        Categoria::factory(10)->create();
        Publicacion::factory(70)->create();
        Comentario::factory(140)->create();
        CategoriaPublicacion::factory(100)->create();
    }
}
