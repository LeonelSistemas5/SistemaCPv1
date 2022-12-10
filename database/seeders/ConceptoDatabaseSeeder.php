<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Concepto;
use Illuminate\Database\Seeder;

class ConceptoDatabaseSeeder extends Seeder
{
    public function run()
    {
        Concepto::firstOrCreate(['denominacion' => 'Pago por matrícula'],[
            'denominacion' => 'Pago por matrícula',
            'precio' => 70.60
        ]); 

        Concepto::firstOrCreate(['denominacion' => 'Pago por certificado'],[
            'denominacion' => 'Pago por certificado',
            'precio' => 20.60
        ]);
    }
}
