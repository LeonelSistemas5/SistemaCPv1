<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaDatabaseSeeder extends Seeder
{
    public function run()
    {
        Persona::firstOrCreate(['dni' => '76458723'],[
            'dni' => '76458723',
            'nombres' => 'Drake Leonel',
            'a_paterno' => 'Chambilla',
            'a_materno' => 'Choquecota',
            'direccion' => 'Jr. Jose Galvez 302',
            'celular' => '987567422',
        ]);

        Persona::firstOrCreate(['dni' => '76458453'],[
            'dni' => '76458453',
            'nombres' => 'Jose Luis',
            'a_paterno' => 'Cari',
            'a_materno' => 'Callata',
            'direccion' => 'Jr. Lima 354',
            'celular' => '987567897',
        ]);

        Persona::firstOrCreate(['dni' => '76459723'],[
            'dni' => '76459723',
            'nombres' => 'Cesar Claudio',
            'a_paterno' => 'Cusi',
            'a_materno' => 'Justo',
            'direccion' => 'Jr. Lambayeque 459',
            'celular' => '987764987',
        ]);
    }
}
