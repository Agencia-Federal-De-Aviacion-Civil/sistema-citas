<x-app-layout>
    @canany('super_admin.see.dashboard')
    @include('afac.dashboard.dashboard_superadmin')
    @endcanany
    @can('user.see.navigation')
    @livewire('dashboard')
    @endcan
    @can('see.general.dashboard.except.admins')
    @include('afac.dashboard.dashboard_main')
    @endcan
</x-app-layout>