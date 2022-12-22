<div>
    <x-modal>
        <x-slot name="trigger">
            <button class="btn btn-primary" @click="on = true"><i class="fa-solid fa-plus mr-2"></i>Registrar Sede</button>
        </x-slot>

        <x-slot name="title">
            Registrar Sede
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="w-full col-span-1 md:col-span-2">
                    <x-form.input wire:model="denominacion" label="Denominacion" name="denominacion" required>{{ old('denominacion') }}</x-form.input>
                </div>
                <div class="w-full col-span-1 md:col-span-2">
                    <x-form.input wire:model="direccion" label="Dirección" name="direccion">{{ old('direccion') }}</x-form.input>
                </div>
                <div class="w-full">
                    <x-form.input wire:model="telefono" label="Telefono" name="telefono">{{ old('telefono') }}</x-form.input>
                </div>
                <div class="w-full">
                    <x-form.input wire:model="celular" label="Celular" name="celular">{{ old('celular') }}</x-form.input>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button class="btn" @click="on = false">Cancelar</button>
            <button class="btn btn-primary" wire:click="store">Registrar</button>
        </x-slot>
    </x-modal>
</div>
