<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Roles;

use App\Http\Livewire\Base;
use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;

use function view;

class Roles extends Base
{
    use WithPagination;

    public $role = null;
    public $label = '';
    public $permission = [];

    public $paginate  = '';
    public $search     = '';
    public $sortField = 'name';
    public $sortAsc   = false;
    protected $listeners  = ['alert' => 'alert'];

    protected function rules(): array
    {
        return [
            'label' => 'required|string|unique:roles,label,'.$this->role->id
        ];
    }

    protected array $messages = [
        'label.required' => 'El rol es requerido'
    ];

    public function updating(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $modules = Permission::select('module')->distinct()->orderBy('module')->pluck('module');
        return view('livewire.admin.usuarios.roles.index',compact('modules'));
    }

    public function alert($alert): void
    {
        flash($alert);
        $this->render();
    }

    public function builder()
    {
        return Role::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
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

    public function roles(): object
    {
        $query = $this->builder();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return $query->paginate($this->paginate);
    }

    public function edit($id): void
    {
        $this->role = $this->builder()->findOrFail($id);
        $this->label = $this->role->label;

        if (isset($this->role->permissions)) {
            foreach ($this->role->permissions as $perm) {
                $this->permission[] = $perm->id;
            }
        }
    }

    public function update(): void
    {
        $this->validate();

        $this->role->label = $this->label;
        $this->role->name  = strtolower(str_replace(' ', '_', $this->label));

        //sync given permissions
        $permissions = $this->permission;

        if ($permissions !== null) {
            $this->role->syncPermissions($permissions);
        }

        $this->role->save();

        add_user_log([
            'title'        => 'Rol actualizado '.$this->label,
            'link'         => route('admin.usuarios.roles', ['role' => $this->role->id]),
            'reference_id' => $this->role->id,
            'section'      => 'Roles',
            'type'         => 'Update'
        ]);

        flash('Rol actualizado satisfactoriamente')->success();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete($id): void
    {
        $this->builder()->findOrFail($id)->delete();

        add_user_log([
            'title'        => 'Rol eliminado '.$this->label,
            'link'         => route('admin.usuarios.roles', ['role' => $id]),
            'reference_id' => $id,
            'section'      => 'Roles',
            'type'         => 'Update'
        ]);

        flash('Rol eliminado satisfactoriamente')->error();

        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
