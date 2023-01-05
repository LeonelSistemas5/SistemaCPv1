@section('title', 'Inscritos')
<div>
    <h3>Participantes del curso <b><em>"{{ $this->curso()->denominacion }}"</em></b></h3>
    <div class="card">
        @include('errors.messages')
        <div class="mb-4 flex justify-end">
            <div>
                <div>

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

    @if(count($this->inscritos())>0)
    <div class="card">

        <div class="mb-4 overflow-auto">
            <table>
                <thead>
                    <tr class="border border-slate-200">
                        <th class="border border-slate-200 uppercase">DNI</th>
                        <th class="border border-slate-200 uppercase">Nombres</th>
                        <th class="border border-slate-200 uppercase">Apellidos</th>
                        <th class="w-5 border border-slate-200 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($this->inscritos() as $item)
                    @if(!empty($item->User->Colegiado->codigo))
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200">{{ $item->User->Colegiado->dni }}</td>
                        <td class="border border-slate-200">{{ $item->User->Colegiado->nombres }}</td>
                        <td class="border border-slate-200">{{ $item->User->Colegiado->a_paterno }} {{ $item->User->Colegiado->a_materno }}</td>
                        <td class="border flex justify-center border-slate-200">
                            <div class="flex space-x-2">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-gray" @click="on = true" wire:click="edit({{ $item->id }})"><i class="fa-solid fa-circle-info"></i></a>
                                    </x-slot>
                                    <x-slot name="title">
                                        {{$item->rol_curso=='0'?'Estudiante':'Docente'}} {{ $item->User->Colegiado->nombres }}
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="overflow-y-auto h-60">
                                            <div class="flex justify-cente">
                                                <img src="{{ storage_url($item->User->image) }}" class="mx-auto h-15 w-15 rounded-full " alt="icon">
                                            </div>
                                            <h3>Acciones</h3>
                                            <div class="mt-3 flex justify-center">
                                                <button type="button" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="fa-solid fa-clipboard-user"></i>
                                                    <div>Asistencias</div>
                                                </button>
                                                <button type="button" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="fa-solid fa-book-open-reader"></i>
                                                    <div>Notas</div>
                                                </button>
                                                <button type="button" wire:click="update({{$item->id}})" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="{{$item->rol_curso=='0'?'fa-solid fa-person-chalkboard':'fa-sharp fa-solid fa-book'}}"></i>
                                                    <div>{{$item->rol_curso=='0'?'Hacer docente':'Hacer estudiante'}}</div>
                                                </button>
                                            </div>
                                            <h3>Datos</h3>
                                            <x-form.input label="Código del Participante" class="pt-3" name="DNI" required disabled>{{ $item->User->Colegiado->codigo }}</x-form.input>
                                            <x-form.input label="DNI del Participante" name="DNI" required disabled>{{ $item->User->Colegiado->dni }}</x-form.input>
                                            <x-form.input label="Nombre Completo del Participante" name="nombreCompleto" required disabled>{{ $item->User->Colegiado->nombres }} {{ $item->User->Colegiado->a_paterno }} {{ $item->User->Colegiado->a_materno }}</x-form.input>
                                            <x-form.input label="Número de Celular del Participante" name="celular" required disabled>{{ $item->User->Colegiado->celular }}</x-form.input>
                                            <x-form.input label="Correo Electrónico del Participante" name="email" required disabled>{{ $item->User->email }}</x-form.input>
                                        </div>
                                    </x-slot>
                                    <x-slot name="footer">
                                        <button class="btntext-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" @click="on = false" wire:click="cleanModal()">Cerrar</button>
                                        <button class="btn border-none focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" wire:click="delete({{$item->id}})">Eliminar participante</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                    @elseif(!empty($item->User->Personas->dni))
                    <tr class="border border-slate-200">
                        <td class="border border-slate-200">{{ $item->User->Colegiado->dni }}</td>
                        <td class="border border-slate-200">{{ $item->User->Colegiado->nombres }}</td>
                        <td class="border border-slate-200">{{ $item->User->Colegiado->a_paterno }} {{ $item->User->Colegiado->a_materno }}</td>
                        <td class="border flex justify-center border-slate-200">
                            <div class="flex space-x-2">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <a href="#" class="btn btn-gray" @click="on = true" wire:click="edit({{ $item->id }})"><i class="fa-solid fa-circle-info"></i></a>
                                    </x-slot>
                                    <x-slot name="title">
                                        {{$item->rol_curso=='0'?'Estudiante':'Docente'}} {{ $item->User->Colegiado->nombres }}
                                    </x-slot>
                                    <x-slot name="content">
                                        <div class="overflow-y-auto h-60">
                                            <div class="flex justify-cente">
                                                <img src="{{ storage_url($item->User->image) }}" class="mx-auto h-15 w-15 rounded-full " alt="icon">
                                            </div>
                                            <h3>Acciones</h3>
                                            <div class="mt-3 flex justify-center">
                                                <button type="button" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="fa-solid fa-clipboard-user"></i>
                                                    <div>Asistencias</div>
                                                </button>
                                                <button type="button" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="fa-solid fa-book-open-reader"></i>
                                                    <div>Notas</div>
                                                </button>
                                                <button type="button" wire:click="update({{$item->id}})" class="flex space-x-2 items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"><i class="{{$item->rol_curso=='0'?'fa-solid fa-person-chalkboard':'fa-sharp fa-solid fa-book'}}"></i>
                                                    <div>{{$item->rol_curso=='0'?'Hacer docente':'Hacer estudiante'}}</div>
                                                </button>
                                            </div>
                                            <h3>Datos</h3>
                                            <x-form.input label="DNI del Participante" name="DNI" required disabled>{{ $item->User->Colegiado->dni }}</x-form.input>
                                            <x-form.input label="Nombre Completo del Participante" name="nombreCompleto" required disabled>{{ $item->User->Colegiado->nombres }} {{ $item->User->Colegiado->a_paterno }} {{ $item->User->Colegiado->a_materno }}</x-form.input>
                                            <x-form.input label="Número de Celular del Participante" name="celular" required disabled>{{ $item->User->Colegiado->celular }}</x-form.input>
                                            <x-form.input label="Correo Electrónico del Participante" name="email" required disabled>{{ $item->User->email }}</x-form.input>
                                        </div>
                                    </x-slot>
                                    <x-slot name="footer">
                                        <button class="btn" @click="on = false" wire:click="cleanModal()">Cerrar</button>
                                        <button class="btn" wire:click="delete({{$item->id}})">Eliminar participante</button>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <p class="text-center">No hay participantes en este curso</p>
    @endif
</div>
