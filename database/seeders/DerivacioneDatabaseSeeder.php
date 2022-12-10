<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Derivacione;
use Illuminate\Database\Seeder;

class DerivacioneDatabaseSeeder extends Seeder
{
    public function run()
    {
        Derivacione::create([
            'hora' => '2022-10-31 05:07:03',
            'tramite_id' => 1,
            'oficina_origen' => 3,
            'oficina_destino'=> 2
        ]);
    }
}
