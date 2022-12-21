<?php

namespace Database\Seeders;

use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use App\Models\Roles\RoleUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        //create developer uncomment to use when seeding
        
        $user = User::firstOrCreate(['email' => 'leonel@domain.com'], [
            'name'                 => 'Leonel',
            'slug'                 => 'leonel',
            'email'                => 'leonel@domain.com',
            'password'             => bcrypt('leonel12345'),
            'is_active'            => 1,
            'sede_id'              => 1,
            'persona_id'         => 1,
            'oficina_id'           => 4,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        RoleUser::firstOrCreate([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);

        //create developer uncomment to use when seeding
        
        $user = User::firstOrCreate(['email' => 'joseluis@domain.com'], [
            'name'                 => 'Jose Luis',
            'slug'                 => 'Jose Luis',
            'email'                => 'joseluis@domain.com',
            'password'             => bcrypt('joseluis12345'),
            'is_active'            => 1,
            'sede_id'              => 1,
            'persona_id'         => 2,
            'oficina_id'           => 3,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        RoleUser::firstOrCreate([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);


        //create developer uncomment to use when seeding
        
        $user = User::firstOrCreate(['email' => 'cesar@domain.com'], [
            'name'                 => 'Cesar',
            'slug'                 => 'cesar',
            'email'                => 'cesar@domain.com',
            'password'             => bcrypt('cesar12345'),
            'is_active'            => 1,
            'sede_id'              => 1,
            'persona_id'         => 3,
            'oficina_id'           => 5,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('name', 'admin')->first();
        RoleUser::firstOrCreate([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);


        //create developer uncomment to use when seeding
        
        $user = User::firstOrCreate(['email' => 'rosmel@domain.com'], [
            'name'                 => 'Rosmel',
            'slug'                 => 'rosmel',
            'email'                => 'rosmel@domain.com',
            'password'             => bcrypt('rosmel12345'),
            'is_active'            => 1,
            'sede_id'              => 1,
            'colegiado_id'         => 1,
            'is_office_login_only' => 0
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id.'.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        $role = Role::where('name', 'colegiado')->first();
        RoleUser::firstOrCreate([
            'role_id' => $role->id,
            'user_id' => $user->id
        ]);
    }
}
