<div>
    <x-2col>
        <x-slot name="left">
            <h3>Roles</h3>
            <p>Active y desactive los roles, los roles deshabilitados deshabilitarán los permisos de los usuarios.</p>
        </x-slot>
        <x-slot name="right">

            <div class="card">
                <x-form wire:submit.prevent="update" method="put">

                    @foreach($roles as $role)
                        <p><input type="checkbox" wire:model="roleSelections" value="{{ $role->id }}"> {{ $role->label }}</p>
                    @endforeach

                    <x-button class="mt-5">Actualizar Roles</x-button>

                    @include('errors.messages')

                </x-form>
            </div>

        </x-slot>
    </x-2col>

</div>