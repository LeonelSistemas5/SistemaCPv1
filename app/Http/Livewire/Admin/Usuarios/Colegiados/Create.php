<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Colegiados;

use App\Http\Livewire\Base;
use App\Mail\Users\SendInviteMail;
use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Oficina;
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
    public    $codigo = '';
    public    $nombres = '';
    public    $a_paterno = '';
    public    $a_materno = '';
    public    $direccion = '';
    public    $celular = '';
    public    $capitulo_id = '';

    public    $name       = '';
    public    $email      = '';
    public    $joined     = '';
    public    $is_active;
    public    $sede_id = '';

    protected function rules(): array
    {
        return [
            'dni'           => 'required|min:8|max:8',
            'codigo'        => 'required|min:6|max:6|unique:colegiados,codigo',
            'nombres'       => 'required|max:191',
            'a_paterno'     => 'required|max:191',
            'a_materno'     => 'required|max:191',
            'direccion'     => 'max:191',
            'capitulo_id'   => 'required',
            'celular'       => 'max:9|min:9',
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:users,email',
            'sede_id'       => 'required',
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
        $capitulos = Capitulo::all();
        $sedes = Sede::all();
        $oficinas = Oficina::all();

        return view('livewire.admin.usuarios.colegiados.create', compact('capitulos', 'sedes', 'oficinas'));
    }

    public function store(): void
    {
        $this->validate();

        $colegiado = Colegiado::create([
            'dni' => $this->dni,
            'codigo' => $this->codigo,
            'nombres' => $this->nombres,
            'a_paterno' => $this->a_paterno,
            'a_materno' => $this->a_materno,
            'direccion' => $this->direccion,
            'celular' => $this->celular,
            'capitulo_id' => $this->capitulo_id
        ]);

        $user = User::create([
            'name'                 => $this->name,
            'slug'                 => Str::slug($this->name),
            'email'                => $this->email,
            'sede_id'              => $this->sede_id,
            'colegiado_id'         => $colegiado->id,
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

        $role = Role::where('name', 'colegiado')->first();
        RoleUser::create([
            'role_id' => $role->id,
            'user_id' => $user->id,
        ]);


        Mail::send(new SendInviteMail($user));

        add_user_log([
            'title'        => "Invitación " . $user->name,
            'reference_id' => $user->id,
            'section'      => 'Colegiados',
            'type'         => 'Join'
        ]);

        $this->emitTo('admin.usuarios.colegiados.colegiados', 'alert', 'Colegiado invitado satisfactoriamente');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
