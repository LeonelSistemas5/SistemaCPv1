<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tramite;
use Illuminate\Database\Seeder;

class TramiteDatabaseSeeder extends Seeder
{
    public function run()
    {
        Tramite::Create([
            'fecha_emision' => '2022-12-5',
            'fecha_recepcion' => '2022-12-5',
            'tramitetipo_id' => 1,
            'colegiado_id' => 1
        ]);
    }
}
