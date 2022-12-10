<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Inscripcione;
use App\Models\User;
use Illuminate\Database\Seeder;

class InscripcioneDatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('name','Leonel')->value('id');
        Inscripcione::firstOrCreate(['codigo' => '123658745896587452135'],[
            'codigo' => '123658745896587452135',
            'asistencia' => 15,
            'nota_final' => 0,
            'rol_curso' => '0',
            'user_id' => $user,
            'curso_id' => 1
        ]);

        $user = User::where('name','Jose Luis')->value('id');
        Inscripcione::firstOrCreate(['codigo' => '323658745896587452133'],[
            'codigo' => '323658745896587452133',
            'asistencia' => 15,
            'nota_final' => 0,
            'rol_curso' => '0',
            'user_id' => $user,
            'curso_id' => 2
        ]);

        $user = User::where('name','Cesar')->value('id');
        Inscripcione::firstOrCreate(['codigo' => '223658745896587432133'],[
            'codigo' => '223658745896587432133',
            'asistencia' => 15,
            'nota_final' => 0,
            'rol_curso' => '1',
            'user_id' => $user,
            'curso_id' => 2
        ]);
    }
}
