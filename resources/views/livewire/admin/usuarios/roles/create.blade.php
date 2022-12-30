<div>
    @if(can('add_role'))
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true"><i class="fa-solid fa-plus mr-2"></i>Registrar Rol</button>
        </x-slot>

        <x-slot name="title">Registrar Rol</x-slot>

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
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Registrar</button>
        </x-slot>

    </x-modal>
    @endif
</div>
