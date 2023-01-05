<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true">Crear un nuevo tipo de Tramite</button>
        </x-slot>

        <x-slot name="title">
            Registrar Tipo de tramite
        </x-slot>

        <x-slot name="content">
            <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required>{{ old('denominacion') }}</x-form.input>
            <br>
            <div class="overflow-y-auto h-60">
                <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required>{{ old('denominacion') }}</x-form.input>
                <x-form.input wire:model="precio_certificado" label="Precio del certificado" name="precio_certificado" required></x-form.input>
                <x-form.input wire:model="fecha_inicio" type="date" label="Inicia en:" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required></x-form.input>
                <x-form.input wire:model="fecha_fin" type="date" label="Finaliza en:" name="fecha_fin" value="{{ old('fecha_fin') }}" required></x-form.input>
                <label for="temario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Temario del curso</label>
                <textarea wire:model="temario" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                <!-- <label for="estado" class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Estado del curso</label>
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
                </select> -->
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Registrar</button>
        </x-slot>
    </x-modal>
</div>