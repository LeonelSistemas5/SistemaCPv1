@section('title', 'Cursos')
<div>
    <h1>Cursos</h1>
    <div class="card">
        @include('errors.messages')
        <div class="mb-4 flex justify-end">
            <div>
                <div>
                    <livewire:admin.cursos.create />
                </div>
            </div>
        </div>

        <div class="grid items-center grid-cols-1 gap-0 md:grid-cols-4 md:gap-4">
            <div class="col-span-1 md:col-span-3">
                <x-form.input type="search" name="search" wire:model="search" label="none" class="mt-0 md:mt-2" placeholder="Buscar conceptos">

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

        <h3 class="mb-4">Listado de Cursos</h3>

        <div class="mb-4 overflow-auto">
            <table>
                <thead>
                    <tr class="border border-slate-200">
                        <th class="border border-slate-200 uppercase">Id</th>
                        <th class="border border-slate-200 uppercase">Denominación</th>
                        <th class="w-5 border border-slate-200 uppercase">Estado</th>
                        <th class="w-5 border border-slate-200 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->cursos() as $item)
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200">{{ $item->id }}</td>
                        <td class="border border-slate-200">{{ $item->denominacion }}</td>
                        <td class="border border-slate-200">
                            @if($item->estado=="0")
                            <span class="bg-indigo-100 text-indigo-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-900">Esperando</span>
                            @elseif($item->estado==1)
                            <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">En proceso</span>
                            @else
                            <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Finalizado</span>
                            @endif
                        </td>

                        <td class="border border-slate-200">
                            <div class="flex space-x-2">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-blue" @click="on = true" wire:click="edit({{ $item->id }})"><i class="fa-solid fa-eye"></i></a>
                                    </x-slot>
                                    <x-slot name="title">
                                        Curso
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="overflow-y-auto h-60">
                                            <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required disabled></x-form.input>
                                            <x-form.input wire:model="precio_certificado" label="Precio del certificado" name="precio_certificado" required disabled></x-form.input>
                                            <x-form.input wire:model="fecha_inicio" type="date" label="Inicia en:" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required disabled></x-form.input>
                                            <x-form.input wire:model="fecha_fin" type="date" label="Finaliza en:" name="fecha_fin" value="{{ old('fecha_fin') }}" required disabled></x-form.input>
                                            <!-- <x-form.input wire:model="temario" label="Temario del curso" name="temario" required disabled>{{ old('temario') }}</x-form.input> -->
                                            <label for="temario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temario del curso</label>
                                            <textarea wire:model="temario" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled></textarea>
                                        </div>
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
                                        <div class="overflow-y-auto h-60">
                                            <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required>{{ old('denominacion') }}</x-form.input>
                                            <x-form.input wire:model="precio_certificado" label="Precio del certificado" name="precio_certificado" required></x-form.input>
                                            <x-form.input wire:model="fecha_inicio" type="date" label="Inicia en:" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required></x-form.input>
                                            <x-form.input wire:model="fecha_fin" type="date" label="Finaliza en:" name="fecha_fin" value="{{ old('fecha_fin') }}" required></x-form.input>
                                            <label for="temario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temario del curso</label>
                                            <textarea wire:model="temario" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                                            <label for="estado" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Estado del curso</label>
                                            <select wire:model="estado" id="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                @if(old('estado')==0)
                                                <option value="0" selected>Esperando</option>
                                                @else
                                                <option value="0">Esperando</option>
                                                @endif
                                                @if(old('estado')=="1")
                                                <option value="1" selected>En proceso</option>
                                                @else
                                                <option value="1">En proceso</option>
                                                @endif
                                                @if(old('estado')==2)
                                                <option value="2" selected>Finalizado</option>
                                                @else
                                                <option value="2">Finalizado</option>
                                                @endif
                                            </select>
                                        </div>
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
                                            El curso <b>{{ $item->denominacion }}</b> se eliminará permanentemente
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
    </div>
</div>
