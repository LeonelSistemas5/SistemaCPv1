<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Database\Seeder;

class PagoDatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('name','Leonel')->value('id');
        Pago::Create([
            'fecha' => '2022-12-9',
            'observacion' => 'Ninguna',
            'estado' => '0',
            'user_id' => $user
        ]);
    }
}
