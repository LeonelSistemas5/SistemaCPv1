<div>
    @if (can('add_users'))
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true"><i class="fa-solid fa-plus mr-2"></i>Invitar Colegiado</button>
        </x-slot>

        <x-slot name="title">Invitar Colegiado</x-slot>

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
            <button class="btn btn-primary" wire:click="store">Enviar invitación al colegiado</button>
        </x-slot>

    </x-modal>
    @endif
</div>