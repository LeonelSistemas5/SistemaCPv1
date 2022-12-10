<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Oficina;
use Illuminate\Database\Seeder;

class OficinaDatabaseSeeder extends Seeder
{
    public function run()
    {
        Oficina::firstOrCreate(['denominacion' => 'Gerencia General'],[
            'denominacion' => 'Gerencia General'
        ]);

        Oficina::firstOrCreate(['denominacion' => 'Oficina de Tecnologías de la Información'],[
            'denominacion' => 'Oficina de Tecnologías de la Información'
        ]);

        Oficina::firstOrCreate(['denominacion' => 'Oficina de Mesa de Partes'],[
            'denominacion' => 'Oficina de Mesa de Partes'
        ]);

        Oficina::firstOrCreate(['denominacion' => 'Oficina de Caja'],[
            'denominacion' => 'Oficina de Caja'
        ]);

        Oficina::firstOrCreate(['denominacion' => 'Oficina de Cursos'],[
            'denominacion' => 'Oficina de Cursos'
        ]);
    }
}
