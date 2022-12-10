<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Colegio;
use Illuminate\Database\Seeder;

class ColegioDatabaseSeeder extends Seeder
{
    public function run()
    {
        Colegio::firstOrCreate(['ruc' => '20138086438'],[
            'ruc' =>'20138086438',
            'razon_social' => 'Colegio de Ingenieros del Perú',
            'email' => 'cip@domain.com'
        ]);
    }
}
