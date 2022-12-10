<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Capitulo;
use Illuminate\Database\Seeder;

class CapituloDatabaseSeeder extends Seeder
{
    public function run()
    {
        Capitulo::firstOrCreate(['denominacion' => 'Ingeniería en Sistemas'],[
            'denominacion' => 'Ingeniería en Sistemas'
        ]);

        Capitulo::firstOrCreate(['denominacion' => 'Ingeniería Electrónica'],[
            'denominacion' => 'Ingeniería Electrónica'
        ]);

        Capitulo::firstOrCreate(['denominacion' => 'Ingeniería Mecánica Electrica'],[
            'denominacion' => 'Ingeniería Mecánica Electrica'
        ]);
    }
}
