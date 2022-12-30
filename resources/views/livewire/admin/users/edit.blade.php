@section('title', 'Editar Cuenta')
<div>
    <h1 class="mb-4">Cuenta</h1>

    <livewire:admin.users.edit.profile :user="$user" />
    <livewire:admin.users.edit.change-password :user="$user" />
    <livewire:admin.users.edit.two-factor-authentication :user="$user" />
</div>