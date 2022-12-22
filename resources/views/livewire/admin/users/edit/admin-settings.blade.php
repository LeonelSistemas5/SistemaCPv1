<div>
    <x-2col>
        <x-slot name="left">
            <h3>Configuración de administrador</h3>
        </x-slot>
        <x-slot name="right">
            <div class="card">

                <x-form wire:submit.prevent="update" method="put">

                    <fieldset>

                        <div class="mt-1 bg-white dark:bg-gray-500 dark:text-gray-200 rounded-md shadow-sm -space-y-px">

                            <div class="relative border rounded-tl-md rounded-tr-md p-4 flex border-gray-200">
                                <div class="flex items-center h-5">
                                    <input wire:model="isOfficeLoginOnly" id="isOfficeLoginOnly" type="checkbox" class="h-4 w-4 text-light-blue-600 cursor-pointer focus:ring-light-blue-500 border-gray-300" checked="">
                                </div>
                                <label for="isOfficeLoginOnly" class="ml-3 flex flex-col cursor-pointer">
                                    <span class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Solo inicio de sesión en la oficina
                                    </span>
                                    <span class="block text-sm text-gray-500 dark:text-gray-200">
                                        Cuando el usuario activo solo puede iniciar sesión en direcciones IP preaprobadas establecidas en la <a href="{{ route('admin.settings') }}">Configuración del sistema</a>.
                                    </span>
                                </label>
                            </div>

                            @if ($user->id !== auth()->id())
                            <div class="relative border rounded-tl-md rounded-tr-md p-4 flex border-gray-200">
                                <div class="flex items-center h-5">
                                    <input wire:model="isActive" id="isActive" type="checkbox" class="h-4 w-4 text-light-blue-600 cursor-pointer focus:ring-light-blue-500 border-gray-300" checked="">
                                </div>
                                <label for="isActive" class="ml-3 flex flex-col cursor-pointer">
                                    <span class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Cuenta activa
                                    </span>
                                    <span class="block text-sm text-gray-500 dark:text-gray-200">
                                        Solo los usuarios activos pueden iniciar sesión.
                                    </span>
                                </label>
                            </div>
                            @endif

                        </div>
                    </fieldset>

                    <x-button class="mt-5">Actualizar Configuración</x-button>

                    @include('errors.success')

                </x-form>
            </div>

        </x-slot>
    </x-2col>
</div>