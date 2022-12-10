<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AppDatabaseSeeder::class,
            AuditTrailsDatabaseSeeder::class,
            RolesDatabaseSeeder::class,
            SentEmailsDatabaseSeeder::class,

            ColegioDatabaseSeeder::class,
            PersonaDatabaseSeeder::class,
            ConceptoDatabaseSeeder::class,
            CapituloDatabaseSeeder::class,
            OficinaDatabaseSeeder::class,
            RequisitoDatabaseSeeder::class,
            TramitetipoDatabaseSeeder::class,
            SedeDatabaseSeeder::class,
            PagoDatabaseSeeder::class,
            CursoDatabaseSeeder::class,
            ColegiadoDatabaseSeeder::class,
            TareaDatabaseSeeder::class,
            TramiteDatabaseSeeder::class,
            DerivacioneDatabaseSeeder::class,
            IntentoDatabaseSeeder::class,
            DocumentoDatabaseSeeder::class,

            UserDatabaseSeeder::class,
            InscripcioneDatabaseSeeder::class,
        ]);
    }
}
