@auth
    <div x-data="{ isOpen: false }">
        <div>
            <button @click="isOpen = !isOpen" class="text-gray-900 pt-3 focus:outline-none">
                @if (storage_exists(user()->image))
                    <img src="{{ storage_url(user()->image) }}" width="30" class="h-6 w-6 rounded-full">
                @else
                    {{ user()->name }}
                @endif
            </button>
        </div>

        <div
            x-show.transition="isOpen"
            @click.away="isOpen = false"
            class="origin-top-right absolute right-0 mt-1 mr-3 w-48">
            <div class="relative z-30 rounded-b-md bg-white border border-gray-100 dark:bg-gray-700 shadow-xs">

                @if (can('view_users_profiles'))
                    <x-dropdown-link :href="route('admin.profile', ['user' => user()->id])">Ver Perfil</x-dropdown-link>
                @endif

                @if (can('edit_own_account'))
                    <x-dropdown-link :href="route('admin.profile.edit', ['user' => user()->id])">Editar Cuenta</x-dropdown-link>
                @endif

                <hr>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-400">Cerrar
                    Sessión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    {{ csrf_field() }}
                </form>

            </div>

        </div>
    </div>
@endauth