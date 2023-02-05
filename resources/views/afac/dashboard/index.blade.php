<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido al sistema de Citas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white shadow-xl sm:rounded-lg">
                <div class="mt-5 mb-4">
                   @livewire('appointment.generate')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
