<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'editor',
            'usuario'
        ];

        foreach($roles as $r) {
            $rol = new Rol();

            $rol->rol = $r;

            $rol->save();
        }
    }
}
