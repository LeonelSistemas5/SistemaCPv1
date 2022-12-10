<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Requisito;
use Illuminate\Database\Seeder;

class RequisitoDatabaseSeeder extends Seeder
{
    public function run()
    {
        Requisito::firstOrCreate(['denominacion' => 'DNI'],[
            'denominacion' => 'DNI'
        ]);

        Requisito::firstOrCreate(['denominacion' => 'Bachiller Universitario'],[
            'denominacion' => 'Bachiller Universitario'
        ]);

        Requisito::firstOrCreate(['denominacion' => 'Título Universitario'],[
            'denominacion' => 'Título Universitario'
        ]);
    }
}
