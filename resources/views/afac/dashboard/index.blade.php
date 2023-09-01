<x-app-layout>
    @can('headquarters.see.dashboard')
    @include('afac.dashboard.dashboard_headquarters')
    @endcan
    @can('sub_headquarters.see.dashboard')
    @include('afac.dashboard.dashboard_headquarters')
    @endcan
    @can('medicine_admin.see.dashboard')
    @include('afac.dashboard.dashboard_medicine')
    @endcan
    @can('super_admin.see.dashboard')
    @include('afac.dashboard.dashboard_superadmin')
    @endcan
    @can('user.see.navigation')
    @livewire('dashboard')
    @endcan
    @can('headquarters_authorized.see.dashboard')
    @include('afac.dashboard.dashboard_headquarters_third')
    @endcan
</x-app-layout>