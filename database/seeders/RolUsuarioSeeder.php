<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\RolUsuario;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cantAdmins = 5;
        $cantEditores = 10;
        $usuariosIds = Usuario::select('id')->pluck('id');

        for($i = 0; $i < $cantAdmins; $i ++) {
            $rolUsuario = new RolUsuario();

            $rolUsuario->usuario_id = $usuariosIds[$i];
            $rolUsuario->rol_id = Rol::select('id')->where('rol', 'admin')->first()->id;

            $rolUsuario->save();
        }

        for($i = 0; $i < $cantEditores; $i ++) {
            $rolUsuario = new RolUsuario();

            $rolUsuario->usuario_id = $usuariosIds[$i];
            $rolUsuario->rol_id = Rol::select('id')->where('rol', 'editor')->first()->id;

            $rolUsuario->save();
        }
    }
}
