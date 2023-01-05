<button @click.stop="sidebarOpen = !sidebarOpen" class="md:hidden focus:outline-none pl-1 pt-4 pr-2">
    <svg class="w-6 transition ease-in-out duration-150 text-white" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>

<div class="py-4">
    <a href="{{ route('admin') }}" class="text-gray-100 font-bold">
        @php
        //cache the logo setting to reduce calling the database
        $applicationLogo = Cache::rememberForever('applicationLogo', function () {
        return \App\Models\Setting::where('key', 'applicationLogo')->value('value');
        });

        $applicationLogoDark = Cache::rememberForever('applicationLogoDark', function () {
        return \App\Models\Setting::where('key', 'applicationLogoDark')->value('value');
        });
        @endphp

        @if (storage_exists($applicationLogo))
        <picture>
            <source srcset="{{ storage_url($applicationLogoDark) }}" media="(prefers-color-scheme: dark)">
            <img src="{{ storage_url($applicationLogo) }}" alt="{{ config('app.name') }}">
        </picture>
        @else
        {{ config('app.name') }}
        @endif
    </a>
</div>

@if(can('view_dashboard'))
<x-nav.link route="admin" icon="fas fa-home">Dashboard</x-nav.link>
@endif

<x-nav.link route="admin.cursos.index" icon="fa-solid fa-book">Cursos</x-nav.link>

<x-nav.group label="Cajas" route="admin.cajas" icon="fa-solid fa-cash-register">
    <x-nav.group-item route="admin.cajas.pagos" icon="far fa-circle">Pagos</x-nav.group-item>
    <x-nav.group-item route="admin.cajas.conceptos" icon="far fa-circle">Conceptos</x-nav.group-item>
</x-nav.group>

<x-nav.group label="Tramites" route="admin.tramites.index" icon="fa-solid fa-folder">
    <x-nav.group-item route="admin.tramites.oficina" icon="far fa-circle">Oficinas</x-nav.group-item>
    <x-nav.group-item route="admin.tramites.tipotramite" icon="far fa-circle">Tipo de Tramites</x-nav.group-item>
    <x-nav.group-item route="admin.tramites.requisito" icon="far fa-circle">Requisitos</x-nav.group-item>
</x-nav.group>

<x-nav.group label="Reportes" route="admin.reportes.index" icon="fa-solid fa-file">

</x-nav.group>

@if(can('view_users'))
<x-nav.group label="Usuarios" route="admin.usuarios" icon="fas fa-users">
    <x-nav.group-item route="admin.usuarios.administradores" icon="far fa-circle">Administradores</x-nav.group-item>
    <x-nav.group-item route="admin.usuarios.colegiados" icon="far fa-circle">Colegiados</x-nav.group-item>
    <x-nav.group-item route="admin.usuarios.roles" icon="far fa-circle">Roles</x-nav.group-item>
</x-nav.group>
@endif

<x-nav.group label="Colegio" route="admin.colegios" icon="fa-sharp fa-solid fa-building-columns">
    <x-nav.group-item route="admin.colegios.general" icon="far fa-circle">General</x-nav.group-item>
    <x-nav.group-item route="admin.colegios.sedes" icon="far fa-circle">Sedes</x-nav.group-item>
    <x-nav.group-item route="admin.colegios.capitulos" icon="far fa-circle">Capitulos</x-nav.group-item>
</x-nav.group>

@if(can('view_audit_trails') || can('view_sent_emails'))
<x-nav.group label="Settings" route="admin.settings" icon="fas fa-cogs">
    @if(can('view_audit_trails'))
    <x-nav.group-item route="admin.settings.audit-trails.index" icon="far fa-circle">Audit Trails</x-nav.group-item>
    @endif

    @if(can('view_sent_emails'))
    <x-nav.group-item route="admin.settings.sent-emails" icon="far fa-circle">Sent Emails</x-nav.group-item>
    @endif

    @if(is_admin())
    <x-nav.group-item route="admin.settings" icon="far fa-circle">System Settings</x-nav.group-item>
    @endif
</x-nav.group>
@endif