<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Colegiados;

use App\Http\Livewire\Base;
use App\Mail\Users\SendInviteMail;
use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

use function abort_if_cannot;
use function now;
use function view;

class Colegiados extends Base
{
    use WithPagination;

    public    $colegiado = null;
    public    $dni = '';
    public    $codigo = '';
    public    $nombres = '';
    public    $a_paterno = '';
    public    $a_materno = '';
    public    $direccion = '';
    public    $celular = '';
    public    $capitulo_id = '';

    public    $user = null;
    public    $name       = '';
    public    $email      = '';
    public    $joined     = '';
    public    $is_active;
    public    $sede_id = '';

    public    $paginate   = '';
    public    $search = '';
    public    $sortField  = 'name';
    public    $sortAsc    = false;
    protected $listeners  = ['alert' => 'alert'];

    protected function rules(): array
    {
        return [
            'dni'           => 'required|min:8|max:8',
            'codigo'        => 'required|min:6|max:6|unique:colegiados,codigo,'. $this->colegiado->id,
            'nombres'       => 'required|max:191',
            'a_paterno'     => 'required|max:191',
            'a_materno'     => 'required|max:191',
            'direccion'     => 'max:191',
            'capitulo_id'   => 'required',
            'celular'       => 'max:9|min:9',
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:users,email,' . $this->user->id,
            'sede_id'       => 'required',
        ];
    }

    protected array $messages = [
        'name.required'          => 'El usuario es requerido',
        'email.required'         => 'El email es requerido',
        'sede_id'                => 'La sede es requerida',
    ];

    public function updating(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        abort_if_cannot('view_users');

        $sedes = Sede::all();
        $capitulos = Capitulo::all();

        return view('livewire.admin.usuarios.colegiados.index',compact('sedes','capitulos'));
    }

    public function alert($alert): void
    {
        flash($alert);
        $this->render();
    }

    public function builder()
    {
        return User::leftJoin('colegiados', 'users.colegiado_id', '=', 'colegiados.id')
            ->select('users.*')
            ->whereNull('persona_id')
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
        $this->is_active = $this->user->is_active;

        $this->colegiado = Colegiado::find($this->user->colegiado_id);

        $this->codigo = $this->colegiado->codigo;
        $this->dni = $this->colegiado->dni;
        $this->nombres = $this->colegiado->nombres;
        $this->a_paterno = $this->colegiado->a_paterno;
        $this->a_materno = $this->colegiado->a_materno;
        $this->direccion = $this->colegiado->direccion;
        $this->celular = $this->colegiado->celular;
        $this->capitulo_id = $this->colegiado->capitulo_id;
    }

    public function update(): void
    {
        $this->validate();

        $this->colegiado->codigo = $this->codigo;
        $this->colegiado->dni = $this->dni;
        $this->colegiado->nombres = $this->nombres;
        $this->colegiado->a_paterno = $this->a_paterno;
        $this->colegiado->a_materno = $this->a_materno;
        $this->colegiado->direccion = $this->direccion;
        $this->colegiado->celular = $this->celular;
        $this->colegiado->capitulo_id = $this->capitulo_id;

        $this->colegiado->save();

        $this->user->name = $this->name;
        $this->user->email  = $this->email;
        $this->user->is_active = $this->is_active;
        $this->user->sede_id = $this->sede_id;

        $this->user->save();

        add_user_log([
            'title'        => 'Colegiado actualizado ' . $this->name,
            'link'         => route('admin.usuarios.colegiados', ['user' => $this->user->id]),
            'reference_id' => $this->user->id,
            'section'      => 'Colegiados',
            'type'         => 'Update'
        ]);

        flash('Colegiado actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        abort_if_cannot('delete_user');

        $this->builder()->findOrFail($id)->delete();

        flash('Colegiado eliminado satisfactoriamente')->error();

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
