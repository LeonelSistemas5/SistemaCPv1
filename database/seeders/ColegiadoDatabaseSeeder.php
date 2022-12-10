<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Colegiado;
use Illuminate\Database\Seeder;

class ColegiadoDatabaseSeeder extends Seeder
{
    public function run()
    {
        Colegiado::firstOrCreate(['codigo' => '220100'],[
            'codigo' => '220100',
            'dni' => '76458723',
            'nombres' => 'Drake Leonel',
            'a_paterno' => 'Chambilla',
            'a_materno' => 'Choquecota',
            'direccion' => 'Jr. Jose Galvez 302',
            'celular' => '987567422',
            'capitulo_id' => 1
        ]);

        Colegiado::firstOrCreate(['codigo' => '220200'],[
            'codigo' => '220200',
            'dni' => '76458453',
            'nombres' => 'Jose Luis',
            'a_paterno' => 'Cari',
            'a_materno' => 'Callata',
            'direccion' => 'Jr. Lima 354',
            'celular' => '987567897',
            'capitulo_id' => 2
        ]);

        Colegiado::firstOrCreate(['codigo' => '220300'],[
            'codigo' => '220300',
            'dni' => '76459723',
            'nombres' => 'Cesar Claudio',
            'a_paterno' => 'Cusi',
            'a_materno' => 'Justo',
            'direccion' => 'Jr. Lambayeque 459',
            'celular' => '987764987',
            'capitulo_id' => 3
        ]);
    }
}
