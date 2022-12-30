@section('title', 'Perfil')
<div>
    <h1 class="mb-4">Perfil</h1>

    <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-6">
        <div>
            <div class="card">

                <div class="text-center">
                    @if (storage_exists($user->image))
                        <img class="mx-auto h-20 w-20 rounded-full" src="{{ storage_url($user->image) }}" alt="">
                    @endif
                    <h2 class="mb-0">{{ $user->name }}</h2>
                </div>

                <div class="mt-5 text-left">
                    <div class="flex border-b pb-2">
                        <i class="pt-1 pr-1 fa fa-envelope"></i>
                        <div style="width:200px; overflow: auto">{{ $user->email }}</div>
                    </div>
                </div>

           </div>
        </div>

        <div class="lg:col-span-3">
            @if (can('view_users_activity'))
                <livewire:admin.users.activity :user="$user"/>
            @endif
        </div>
    </div>

</div>