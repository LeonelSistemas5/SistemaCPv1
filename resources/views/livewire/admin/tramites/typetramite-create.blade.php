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
        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Registrar</button>
        </x-slot>
    </x-modal>
</div>