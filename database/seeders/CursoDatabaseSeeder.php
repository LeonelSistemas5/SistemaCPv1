<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoDatabaseSeeder extends Seeder
{
    public function run()
    {
        Curso::firstOrCreate(['denominacion' => 'Linux Básico'],[
            'denominacion' => 'Linux Básico',
            'precio_certificado' => 20.60,
            'fecha_inicio' => '2022-12-1',
            'fecha_fin' => '2022-12-15',
            'temario' => 'En el siguente curso se enseñara de Comandos Linux, Historia de Linux y muchos mas',
            'estado' => '0',
            'capitulo_id' => 1
        ]);

        Curso::firstOrCreate(['denominacion' => 'La era de la Electricidad'],[
            'denominacion' => 'La era de la Electricidad',
            'precio_certificado' => 20.60,
            'fecha_inicio' => '2022-12-1',
            'fecha_fin' => '2022-12-15',
            'temario' => 'En el siguente curso se enseñara sobre la era de la electricidad',
            'estado' => '0',
            'capitulo_id' => 2
        ]);
    }
}
