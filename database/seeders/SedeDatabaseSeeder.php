<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Seeder;

class SedeDatabaseSeeder extends Seeder
{
    public function run()
    {
        Sede::firstOrCreate(['denominacion' => 'Sede Puno Principal'],[
            'denominacion' => 'Sede Puno Principal',
            'direccion' => 'Av. Simon Bolivar 234',
            'celular' => '987537547'
        ]);

        Sede::firstOrCreate(['denominacion' => 'Sede Juliaca'],[
            'denominacion' => 'Sede Juliaca',
            'direccion' => 'Jr Tacna 456',
            'celular' => '987537852'
        ]);
    }
}
