<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tramitetipo;
use Illuminate\Database\Seeder;

class TramitetipoDatabaseSeeder extends Seeder
{
    public function run()
    {
        Tramitetipo::firstOrCreate(['denominacion' => 'Constancia de Estudios Regulares'],[
            'denominacion' => 'Constancia de Estudios Regulares'
        ]);
    }
}
