<div class="card">

    <h3 class="mb-4">Datos del Colegio</h3>

    <x-form wire:submit.prevent="update" method="put">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-form.input wire:model="ruc" name="ruc" label="Ruc" required />
            <x-form.input wire:model="razon_social" name="razon_social" label="Razón social" required />
            <x-form.input wire:model="email" name="email" label="Email" required />

        </div>

        <x-button>Actualizar Colegio</x-button>

    </x-form>

    @include('errors.messages')

</div>