<x-app-layout>
    @can('user.generate.appointment')
        @livewire('appointment.generate')
    @endcan
    @can('admin.see.history')
        @livewire('appointment.appointment-history')
    @endcan
</x-app-layout>
