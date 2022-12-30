<div>
    <x-2col>
        <x-slot name="left">
            <h3>Cambiar contraseña</h3>
            <p>Asegúrese de que su cuenta esté usando una contraseña larga y aleatoria para mantenerse seguro.</p>
            <p>Use un administrador de contraseñas, recomendamos usar 1Password para crear y almacenar contraseñas o <a href="https://passwordsgenerator.net/" target="blank">passwordsgenerator.net</a></p>
        </x-slot>
        <x-slot name="right">

            <div class="card">
                <x-form wire:submit.prevent="update" method="put">

                    <x-form.input wire:model="newPassword" type="password" label='Nueva Contraseña' name='newPassword'></x-form.input>
                    <x-form.input wire:model="confirmPassword" type="password" label='Confirmar Contraseña' name='confirmPassword'></x-form.input>

                    <x-button>Cambiar contraseña</x-button>

                    @include('errors.success')

                </x-form>
            </div>

        </x-slot>
    </x-2col>
</div>