<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Administradores;

use App\Http\Livewire\Base;
use App\Mail\Users\SendInviteMail;
use App\Models\Oficina;
use App\Models\Persona;
use App\Models\Roles\Role;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

use function abort_if_cannot;
use function now;
use function view;

class Administradores extends Base
{
    use WithPagination;

    public    $persona = null;
    public    $dni = '';
    public    $nombres = '';
    public    $a_paterno = '';
    public    $a_materno = '';
    public    $direccion = '';
    public    $celular = '';

    public    $user = null;
    public    $name       = '';
    public    $email      = '';
    public    $joined     = '';
    public    $is_active;
    public    $sede_id = '';
    public    $oficina_id = '';
    public    $rolesSelected = [];

    public    $paginate   = '';
    public    $search = '';
    public    $sortField  = 'name';
    public    $sortAsc    = false;
    protected $listeners  = ['alert' => 'alert'];

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
            'email'         => 'required|string|email|unique:users,email,' . $this->user->id,
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

    public function updating(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        abort_if_cannot('view_users');

        $sedes = Sede::all();
        $oficinas = Oficina::all();
        $roles = Role::whereNot('name','colegiado')
            ->orderby('name')->get();

        return view('livewire.admin.usuarios.administradores.index', compact('sedes', 'oficinas', 'roles'));
    }

    public function alert($alert): void
    {
        flash($alert);
        $this->render();
    }

    public function builder()
    {
        return User::leftJoin('personas', 'users.persona_id', '=', 'personas.id')
            ->select('users.*')
            ->whereNull('colegiado_id')
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function users()
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orwhere('email', 'like', '%' . $this->search . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $this->user = $this->builder()->findOrFail($id);
        $this->name  = $this->user->name;
        $this->email = $this->user->email;
        $this->sede_id = $this->user->sede_id;
        $this->oficina_id = $this->user->oficina_id;
        $this->is_active = $this->user->is_active;

        $this->persona = Persona::find($this->user->persona_id);

        $this->dni = $this->persona->dni;
        $this->nombres = $this->persona->nombres;
        $this->a_paterno = $this->persona->a_paterno;
        $this->a_materno = $this->persona->a_materno;
        $this->direccion = $this->persona->direccion;
        $this->celular = $this->persona->celular;

        if (isset($this->user->roles)) {
            foreach ($this->user->roles as $rol) {
                $this->rolesSelected[] = $rol->id;
            }
        }
    }

    public function update(): void
    {
        $this->validate();

        $this->persona->dni = $this->dni;
        $this->persona->nombres = $this->nombres;
        $this->persona->a_paterno = $this->a_paterno;
        $this->persona->a_materno = $this->a_materno;
        $this->persona->direccion = $this->direccion;
        $this->persona->celular = $this->celular;

        $this->persona->save();

        $this->user->name = $this->name;
        $this->user->email  = $this->email;
        $this->user->is_active = $this->is_active;
        $this->user->sede_id = $this->sede_id;
        $this->user->oficina_id = $this->oficina_id;

        $roles = $this->rolesSelected;

        if ($roles !== null) {
            $this->user->roles()->sync($roles);
        }

        $this->user->save();

        add_user_log([
            'title'        => 'Administrador actualizado ' . $this->name,
            'link'         => route('admin.usuarios.administradores', ['user' => $this->user->id]),
            'reference_id' => $this->user->id,
            'section'      => 'Administradores',
            'type'         => 'Update'
        ]);

        flash('Administrador actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_user');

        $this->builder()->findOrFail($id)->delete();

        flash('Administrador eliminado satisfactoriamente')->error();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function resendInvite($id): void
    {
        $user = $this->builder()->findOrFail($id);
        Mail::send(new SendInviteMail($user));

        $user->invited_at = now();
        $user->save();

        $this->reset();

        flash('Invitación enviada satisfactoriamente');

        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
