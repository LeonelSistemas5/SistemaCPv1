@section('title', 'Colegiados')
<div>
    <h1>Colegiados</h1>
    <div class="card">
        @include('errors.messages')
        <div class="mb-4 flex justify-end">
            <div>
                @if(can('add_users'))
                <livewire:admin.usuarios.colegiados.create />
                @endif
            </div>
        </div>
        <div class="grid items-center grid-cols-1 gap-0 md:grid-cols-4 md:gap-4">
            <div class="col-span-1 md:col-span-3">
                <x-form.input type="search" name="search" wire:model="search" label="none" class="mt-0 md:mt-2" placeholder="Buscar colegiados">
                    {{ old('name', request('name')) }}
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
        <h3 class="mb-4">Listado de Colegiados</h3>
        <div class="mb-4 overflow-auto">
            <table class="table-auto">
                <thead>
                    <tr class="border border-slate-200">
                        <th class="border border-slate-200"><a href="#" wire:click.prevent="sortBy('name')">Usuario</a></th>
                        <th class="border border-slate-200"><a href="#" wire:click.prevent="sortBy('email')">Email</a></th>
                        <th class="border border-slate-200">Unido</th>
                        <th class="border border-slate-200">Estado</th>
                        <th class="w-5 border border-slate-200">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->users() as $item)
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200">
                            <div class="pl-1 pt-1">{{ $item->name }}</div>
                        </td>
                        <td class="border border-slate-200">{{ $item->email }}</td>
                        <td class="border border-slate-200">
                            @if (! empty($item->invite_token))
                            <small class="dark:text-gray-300">Invitado<br> {{ date('jS M Y H:i', strtotime($item->invited_at)) }}</small>
                            @else
                            {{ $item->created_at !=='' ? date('jS M Y', strtotime($item->created_at)) : '' }}
                            @endif
                        </td>
                        <td class="border border-slate-200">
                            @if($item->is_active == 1)
                            <div class="p-1 text-sm rounded font-bold text-green-600 text-center bg-green-100 shadow">Activo</div>
                            @else
                            <div class="p-1 text-sm rounded font-bold text-red-600 text-center bg-red-100 shadow">Inactivo</div>
                            @endif
                        </td>
                        <td class="border border-slate-200">

                            <div class="flex space-x-2">

                                <!--PERFIL-->
                                @if(can('view_users_profiles'))
                                @if (empty($item->invite_token))
                                <a class="btn" href="{{ route('admin.profile', ['user' => $item->id]) }}">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                @endif
                                @endif

                                <!--INVITAR-->
                                @if(can('add_users'))
                                @if (!empty($item->invite_token))
                                <div class="w-full">
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <a class="btn" href="#" class="w-full" @click="on = true"><i class="fa-solid fa-share"></i></a>
                                        </x-slot>
                                        <x-slot name="title">Enviar otra invitación a {{ $item->name }}</x-slot>
                                        <x-slot name="content"></x-slot>
                                        <x-slot name="footer">
                                            <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                            <button class="btn btn-primary" wire:click="resendInvite('{{ $item->id }}')">Enviar</button>
                                        </x-slot>
                                    </x-modal>
                                </div>
                                @endif
                                @endif

                                <!--DETALLE-->
                                <div>
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <a class="btn btn-blue" href="#" @click="on = true" wire:click="edit('{{ $item->id }}')"><i class="fa-solid fa-eye"></i></a>
                                        </x-slot>

                                        <x-slot name="title">Colegiado</x-slot>

                                        <x-slot name="content">
                                            <x-tab name="datosuser">
                                                <x-tabs.header>
                                                    <x-tabs.link name="datosuser">Datos de usuario</x-tabs.link>
                                                    <x-tabs.link name="datoscolegiado">Datos de colegiado</x-tabs.link>
                                                    <x-tabs.link name="datospersonal">Datos personales</x-tabs.link>
                                                </x-tabs.header>

                                                <x-tabs.div name="datosuser">
                                                    @include('errors.success')
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="name" label="Usuario" name="name" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="email" label="Email" name="email" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.select label="Sede" wire:model="sede_id" required disabled>
                                                                <x-form.select-option selected>Seleccionar</x-form.select-option>
                                                                @foreach($sedes as $sede)
                                                                <x-form.select-option selected value="{{ $sede->id }}">{{ $sede->denominacion }}</x-form.select-option>
                                                                @endforeach
                                                            </x-form.select>
                                                        </div>
                                                        @if (empty($item->invite_token))
                                                        <div class="w-full">
                                                            <x-form.select label="Estado" wire:model="is_active" required>
                                                                <x-form.select-option value="0">Inactivo</x-form.select-option>
                                                                <x-form.select-option value="1">Activo</x-form.select-option>
                                                            </x-form.select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </x-tabs.div>

                                                <x-tabs.div name="datoscolegiado">
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="codigo" label="Código" name="codigo" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.select label="Capítulo" wire:model="capitulo_id" required disabled>
                                                                <x-form.select-option selected>Seleccionar</x-form.select-option>
                                                                @foreach($capitulos as $capitulo)
                                                                <x-form.select-option selected value="{{ $capitulo->id }}">{{ $capitulo->denominacion }}</x-form.select-option>
                                                                @endforeach
                                                            </x-form.select>
                                                        </div>
                                                    </div>
                                                </x-tabs.div>

                                                <x-tabs.div name="datospersonal">
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="dni" label="DNI" name="dni" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="nombres" label="Nombres" name="nombres" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="a_paterno" label="A. Paterno" name="a_paterno" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="a_materno" label="A. Materno" name="a_materno" required disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="direccion" label="Dirección" name="direccion" disabled></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="celular" label="Celular" name="celular" disabled></x-form.input>
                                                        </div>
                                                    </div>
                                                </x-tabs.div>
                                            </x-tab>
                                        </x-slot>

                                        <x-slot name="footer">
                                            <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                        </x-slot>
                                    </x-modal>
                                </div>

                                <!--EDITAR-->
                                <div>
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <a class="btn btn-green" href="#" @click="on = true" wire:click="edit('{{ $item->id }}')"><i class="fa-solid fa-pen-to-square"></i></a>
                                        </x-slot>

                                        <x-slot name="title">Editar Colegiado</x-slot>

                                        <x-slot name="content">
                                            <x-tab name="datosuser">
                                                <x-tabs.header>
                                                    <x-tabs.link name="datosuser">Datos de usuario</x-tabs.link>
                                                    <x-tabs.link name="datoscolegiado">Datos de colegiado</x-tabs.link>
                                                    <x-tabs.link name="datospersonal">Datos personales</x-tabs.link>
                                                </x-tabs.header>

                                                <x-tabs.div name="datosuser">
                                                    @include('errors.success')
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="name" label="Usuario" name="name" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="email" label="Email" name="email" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.select label="Sede" wire:model="sede_id" required>
                                                                <x-form.select-option selected>Seleccionar</x-form.select-option>
                                                                @foreach($sedes as $sede)
                                                                <x-form.select-option selected value="{{ $sede->id }}">{{ $sede->denominacion }}</x-form.select-option>
                                                                @endforeach
                                                            </x-form.select>
                                                        </div>
                                                        @if (empty($item->invite_token))
                                                        <div class="w-full">
                                                            <x-form.select label="Estado" wire:model="is_active" required>
                                                                <x-form.select-option value="0">Inactivo</x-form.select-option>
                                                                <x-form.select-option value="1">Activo</x-form.select-option>
                                                            </x-form.select>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </x-tabs.div>

                                                <x-tabs.div name="datoscolegiado">
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="codigo" label="Código" name="codigo" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.select label="Capítulo" wire:model="capitulo_id" required>
                                                                <x-form.select-option selected>Seleccionar</x-form.select-option>
                                                                @foreach($capitulos as $capitulo)
                                                                <x-form.select-option selected value="{{ $capitulo->id }}">{{ $capitulo->denominacion }}</x-form.select-option>
                                                                @endforeach
                                                            </x-form.select>
                                                        </div>
                                                    </div>
                                                </x-tabs.div>

                                                <x-tabs.div name="datospersonal">
                                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                                        <div class="w-full">
                                                            <x-form.input wire:model="dni" label="DNI" name="dni" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="nombres" label="Nombres" name="nombres" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="a_paterno" label="A. Paterno" name="a_paterno" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="a_materno" label="A. Materno" name="a_materno" required></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="direccion" label="Dirección" name="direccion"></x-form.input>
                                                        </div>
                                                        <div class="w-full">
                                                            <x-form.input wire:model="celular" label="Celular" name="celular"></x-form.input>
                                                        </div>
                                                    </div>
                                                </x-tabs.div>
                                            </x-tab>
                                        </x-slot>

                                        <x-slot name="footer">
                                            <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                            <button class="btn btn-green" wire:click="update">Actualizar</button>
                                        </x-slot>
                                    </x-modal>
                                </div>

                                <!--ELIMINAR-->
                                @if(can('delete_users') && auth()->id() !== $item->id)
                                <div>
                                    <x-modal>
                                        <x-slot name="trigger">
                                            <a class="btn btn-red" href="#" @click="on = true"><i class="fa-solid fa-trash"></i></a>
                                        </x-slot>

                                        <x-slot name="title">Confirmar Eliminación</x-slot>

                                        <x-slot name="content">
                                            <div class="text-center">
                                                El colegiado <b>{{ $item->name }}</b> se eliminará de manera permanente
                                            </div>
                                        </x-slot>

                                        <x-slot name="footer">
                                            <button class="btn" @click="on = false" wire:click="cancel">Cancelar</button>
                                            <button class="btn btn-red" wire:click="delete('{{ $item->id }}')">Eliminar</button>
                                        </x-slot>
                                    </x-modal>
                                </div>
                                @endif

                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $this->users()->links() }}
    </div>
</div>