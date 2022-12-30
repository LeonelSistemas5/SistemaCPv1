<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Administradores;

use App\Http\Livewire\Base;
use App\Mail\Users\SendInviteMail;
use App\Models\Oficina;
use App\Models\Persona;
use App\Models\Roles\Role;
use App\Models\Roles\RoleUser;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function add_user_log;
use function auth;
use function create_avatar;
use function get_initials;
use function now;
use function view;

class Create extends Base
{
    public    $dni = '';
    public    $nombres = '';
    public    $a_paterno = '';
    public    $a_materno = '';
    public    $direccion = '';
    public    $celular = '';

    public    $name       = '';
    public    $email      = '';
    public    $joined     = '';
    public    $is_active;
    public    $sede_id = '';
    public    $oficina_id = '';
    public    $rolesSelected = [];

    protected function rules(): array
    {
        return [
            'dni'           => 'required|min:8|max:8',
            'nombres'       => 'required|max:191',
            'a_paterno'     => 'required|max:191',
            'a_materno'     => 'required|max:191',
            'direccion'     => 'max:191',
            'celular'       => 'max:9|min:9',
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:users,email',
            'sede_id'       => 'required',
            'rolesSelected' => 'required|min:1'
        ];
    }

    protected array $messages = [
        'name.required'          => 'El usuario es requerido',
        'email.required'         => 'El email es requerido',
        'sede_id'                => 'La sede es requerida',
        'rolesSelected.required' => 'Se requiere un rol'
    ];

    /**
     * @throws ValidationException
     */
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render(): View
    {
        $sedes = Sede::all();
        $oficinas = Oficina::all();
        $roles = Role::whereNot('name', 'colegiado')
            ->orderby('name')->get();

        return view('livewire.admin.usuarios.administradores.create', compact('sedes', 'oficinas', 'roles'));
    }

    public function store(): void
    {
        $this->validate();

        $persona = Persona::create([
            'dni' => $this->dni,
            'nombres' => $this->nombres,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'direccion' => $this->direccion,
            'celular' => $this->celular
        ]);

        if ($this->oficina_id == '') {
            $this->oficina_id = null;
        }

        $user = User::create([
            'name'                 => $this->name,
            'slug'                 => Str::slug($this->name),
            'email'                => $this->email,
            'sede_id'              => $this->sede_id,
            'persona_id'           => $persona->id,
            'oficina_id'           => $this->oficina_id,
            'is_active'            => 0,
            'is_office_login_only' => 0,
            'invite_token'         => Str::random(32),
            'invited_by'           => auth()->id(),
            'invited_at'           => now(),
        ]);

        //generate image
        $name      = get_initials($user->name);
        $id        = $user->id . '.png';
        $path      = 'users/';
        $imagePath = create_avatar($name, $id, $path);

        //save image
        $user->image = $imagePath;
        $user->save();

        foreach ($this->rolesSelected as $role_id) {
            RoleUser::create([
                'role_id' => $role_id,
                'user_id' => $user->id,
            ]);
        }

        Mail::send(new SendInviteMail($user));

        add_user_log([
            'title'        => "Invitación " . $user->name,
            'reference_id' => $user->id,
            'section'      => 'Administradores',
            'type'         => 'Join'
        ]);

        $this->emitTo('admin.usuarios.administradores.administradores', 'alert', 'Administrador invitado satisfactoriamente');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
