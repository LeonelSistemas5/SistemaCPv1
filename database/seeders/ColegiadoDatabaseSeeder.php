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
            'dni' => '85214796',
            'nombres' => 'Rosmel',
            'a_paterno' => 'Chila',
            'a_materno' => 'Vilca',
            'direccion' => 'Jr. San Martin 786',
            'celular' => '987567892',
            'capitulo_id' => 1
        ]);
    }
}
