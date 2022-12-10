<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tarea;
use Illuminate\Database\Seeder;

class TareaDatabaseSeeder extends Seeder
{
    public function run()
    {
        Tarea::firstOrCreate(['denominacion' => 'Tarea 1'],[
            'denominacion' => 'Tarea 1',
            'fecha_inicio' => '2022-12-5',
            'fecha_fin' => '2022-12-15',
            'descripcion' => 'Investigar sobre sistemas operativos',
            'curso_id' => 1
        ]);
    }
}
