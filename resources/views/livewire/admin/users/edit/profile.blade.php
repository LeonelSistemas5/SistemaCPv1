<div>
    <div class="card">

        <div class="flex justify-between">
            <h2 class="mb-5">Configuraciones de la cuenta</h2>
        </div>

        <x-form wire:submit.prevent="" method="put">

            <x-form.input wire:model="name" label='Usuario' name='name' required></x-form.input>
            <x-form.input wire:model="email" label='Email' name='email' required></x-form.input>
            <x-form.input wire:model="image" type="file" label='Imagen' name='image'></x-form.input>
            @if ($image)
                Photo Preview:
                <img src="{{ $image->temporaryUrl() }}" width="100px" class="mb-5">
            @elseif(storage_exists($user->image))
                <img src="{{ storage_url($user->image) }}" width="100px" class="mb-5">
            @endif

            <x-button wire:click="update">Actualizar Perfil</x-button>

            @include('errors.messages')

        </x-form>

    </div>
</div>