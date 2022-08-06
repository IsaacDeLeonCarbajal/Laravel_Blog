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
        Usuario::factory(30)->create();
        Categoria::factory(10)->create();
        Publicacion::factory(80)->create();
        Comentario::factory(240)->create();
        CategoriaPublicacion::factory(140)->create();
        $this->call(RolSeeder::class);
        $this->call(RolUsuarioSeeder::class);
    }
}
