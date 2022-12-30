@section('title', 'Roles')
<div>
    <h1>Roles</h1>
    <div class="card">
        @include('errors.messages')
        <div class="mb-4 flex justify-end">
            <livewire:admin.usuarios.roles.create />
        </div>
        <div class="grid items-center grid-cols-1 gap-0 md:grid-cols-4 md:gap-4">
            <div class="col-span-1 md:col-span-3">
                <x-form.input type="search" id="roles" name="search" wire:model="search" label="none" class="mt-0 md:mt-2" placeholder="Buscar roles">
                    {{ old('label', request('label')) }}
                </x-form.input>
            </div>
            <div class="cols-span-1">
                <x-form.select wire:model="paginate">
                    <x-form.select-option selected value="15">15</x-form.select-option>
                    <x-form.select-option value="50">50</x-form.select-option>
                    <x-form.select-option value="100">100</x-form.select-option>
                </x-form.select>
            </div>
        </div>
    </div>

    <div class="card">
        <h3 class="mb-4">Listado de Roles</h3>
        <div class="bg-primary text-gray-50 py-2 px-4 my-5 rounded-md">
            <i class="fa-solid fa-circle-info"></i> De forma predeterminada, el rol administrador tiene todos los permisos y no puede mostrarse, editarse o eliminarse.
        </div>
        <div class="mb-4 overflow-auto">
            <table>
                <thead>
                    <tr class="border border-slate-200">
                        <th class="border border-slate-200 uppercase">
                            <a href="#" wire:click.prevent="sortBy('name')">Denominación</a>
                        </th>
                        <th class="w-5 border border-slate-200 uppercase">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->roles() as $item)
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200 uppercase">{{ $item->label }}</td>
                        <td class="border border-slate-200 uppercase">
                            <div class="flex space-x-2">
                                @if ($item->name == 'admin')

                                @else
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-blue" @click="on = true" wire:click="edit('{{ $item->id }}')"><i class="fa-solid fa-eye"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Rol</x-slot>

                                    <x-slot name="content">

                                        <x-form.input wire:model="label" label="Rol" name="label" required disabled>{{ old('label') }}</x-form.input>

                                        <div class="mx-auto max-w-screen-md">
                                            @foreach($modules as $module)
                                            <h3 class="mt-4">{{ $module }}</h3>
                                            <div class="mb-4 overflow-auto">
                                                <table>
                                                    <thead>
                                                        <tr class="border border-slate-200">
                                                            <th class="border border-slate-200 dark:text-gray-300">Permisos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border border-slate-200">
                                                            <td class="border border-slate-200">
                                                                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                                                    @foreach (\App\Models\Roles\Permission::where('module', $module)->orderby('name')->get() as $perm)
                                                                    <div class="w-full">
                                                                        <input type="checkbox" wire:model="permission" value="{{ $perm->id }}" disabled>
                                                                        {{ $perm->label }}
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endforeach
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                    </x-slot>

                                </x-modal>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-green" @click="on = true" wire:click="edit('{{ $item->id }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Editar Rol</x-slot>

                                    <x-slot name="content">

                                        <x-form.input wire:model="label" label="Rol" name="label" required>{{ old('label') }}</x-form.input>

                                        <div class="mx-auto max-w-screen-md">
                                            @foreach($modules as $module)
                                            <h3 class="mt-4">{{ $module }}</h3>
                                            <div class="mb-4 overflow-auto">
                                                <table>
                                                    <thead>
                                                        <tr class="border border-slate-200">
                                                            <th class="border border-slate-200 dark:text-gray-300">Permisos</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border border-slate-200">
                                                            <td class="border border-slate-200">
                                                                <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                                                    @foreach (\App\Models\Roles\Permission::where('module', $module)->orderby('name')->get() as $perm)
                                                                    <div class="w-full">
                                                                        <input type="checkbox" wire:model="permission" value="{{ $perm->id }}">
                                                                        {{ $perm->label }}
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endforeach
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                        <button class="btn btn-green" wire:click="update">Actualizar</button>
                                    </x-slot>

                                </x-modal>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-red" @click="on = true"><i class="fa-solid fa-trash"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Confirmar Eliminación</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            El rol <b>{{ $item->name }}</b> se eliminará de manera permanente
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false">Cancelar</button>
                                        <button class="btn btn-red" wire:click="delete('{{ $item->id }}')">Eliminar</button>
                                    </x-slot>
                                </x-modal>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $this->roles()->links() }}
    </div>
</div>
