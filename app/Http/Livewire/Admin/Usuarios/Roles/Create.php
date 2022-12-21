<?php

declare(strict_types=1);

namespace App\Http\Livewire\Admin\Usuarios\Roles;

use App\Http\Livewire\Base;
use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;

use function add_user_log;
use function view;

class Create extends Base
{
    public $label = '';
    public $permission = [];

    protected array $rules = [
        'label' => 'required|string|unique:roles,label'
    ];

    protected array $messages = [
        'label.required' => 'El rol es requerido',
        'label.unique' => 'El rol ya esta en uso'
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
        $modules = Permission::select('module')->distinct()->orderBy('module')->pluck('module');
        return view('livewire.admin.usuarios.roles.create',compact('modules'));
    }

    public function store(): void
    {
        $this->validate();

        $role = Role::create([
            'label' => $this->label,
            'name' => strtolower(str_replace(' ', '_', $this->label))
        ]);

        //sync given permissions
        $permissions = $this->permission;

        if ($permissions !== null) {
            $role->syncPermissions($permissions);
        }

        $role->save();

        add_user_log([
            'title'        => 'Rol creado '.$this->label,
            'link'         => route('admin.usuarios.roles', ['role' => $role->id]),
            'reference_id' => $role->id,
            'section'      => 'Roles',
            'type'         => 'created'
        ]);

        $this->emitTo('admin.usuarios.roles.roles','alert','Rol creado satisfactoriamente');
        
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancel(): void
    {
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
}
