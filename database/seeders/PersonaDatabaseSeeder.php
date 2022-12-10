<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Seeder;

class PersonaDatabaseSeeder extends Seeder
{
    public function run()
    {
        Persona::firstOrCreate(['dni' => '85214796'],[
            'dni' => '85214796',
            'nombres' => 'Rosmel',
            'a_paterno' => 'Chila',
            'a_materno' => 'Vilca',
            'direccion' => 'Jr. San Martin 786',
            'celular' => '987567892'
        ]);
    }
}
