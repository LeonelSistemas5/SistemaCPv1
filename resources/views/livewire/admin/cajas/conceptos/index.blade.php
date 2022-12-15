@section('title', 'Conceptos')
<div>
    <h1>Conceptos</h1>
    <div class="card">
        @include('errors.messages')
        <div class="mb-4 flex justify-end">
            <div>
                <livewire:admin.cajas.conceptos.create />
            </div>
        </div>

        <div class="grid items-center grid-cols-1 gap-0 md:grid-cols-4 md:gap-4">
            <div class="col-span-1 md:col-span-3">
                <x-form.input type="search" name="search" wire:model="search" label="none" class="mt-0 md:mt-2" placeholder="Buscar conceptos">
                    {{ old('denominacion', request('denominacion')) }}
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

        <h3 class="mb-4">Listado de Conceptos</h3>

        <div class="mb-4 overflow-auto">
            <table>
                <thead>
                    <tr class="border border-slate-200">
                        <th class="border border-slate-200 uppercase"><a href="#" wire:click.prevent="sortBy('id')">ID</a></th>
                        <th class="border border-slate-200 uppercase"><a href="#" wire:click.prevent="sortBy('denominacion')">Denominación</a></th>
                        <th class="border border-slate-200 uppercase">Precio</th>
                        <th class="w-5 border border-slate-200 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->conceptos() as $item)
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200">{{ $item->id }}</td>
                        <td class="border border-slate-200">{{ $item->denominacion }}</td>
                        <td class="border border-slate-200">{{ $item->precio }}</td>
                        <td class="border border-slate-200">
                            <div class="flex space-x-2">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-blue" @click="on = true" wire:click="edit({{ $item->id }})"><i class="fa-solid fa-eye"></i></a>
                                    </x-slot>
                                    <x-slot name="title">
                                        Concepto
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required disabled>{{ old('denominacion') }}</x-form.input>
                                        <x-form.input wire:model="precio" label="Precio" name="precio" required disabled>{{ old('precio') }}</x-form.input>
                                    </x-slot>
                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false" wire:click="cleanModal()">Cancelar</button>
                                    </x-slot>
                                </x-modal>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-green" @click="on = true" wire:click="edit({{ $item->id }})"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </x-slot>
                                    <x-slot name="title">
                                        Editar Concepto
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required>{{ old('denominacion') }}</x-form.input>
                                        <x-form.input wire:model="precio" label="Precio" name="precio" required>{{ old('denominacion') }}</x-form.input>
                                    </x-slot>
                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false" wire:click="cleanModal()">Cancelar</button>
                                        <button class="btn btn-green" wire:click="update({{ $item->id }})">Actualizar</button>
                                    </x-slot>
                                </x-modal>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-red" @click="on = true"><i class="fa-solid fa-trash"></i></a>
                                    </x-slot>

                                    <x-slot name="title">Confirmar Eliminación</x-slot>

                                    <x-slot name="content">
                                        <div class="text-center">
                                            El concepto <b>{{ $item->denominacion }}</b> se eliminará permanentemente
                                        </div>
                                    </x-slot>

                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false">Cancelar</button>
                                        <button class="btn btn-red" wire:click="delete('{{ $item->id }}')">Eliminar</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $this->conceptos()->links() }}
    </div>
</div>