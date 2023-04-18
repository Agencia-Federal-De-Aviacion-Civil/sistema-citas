<div>

    {{-- {{$scheduleId}} --}}

    <button
    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        wire:click="$emit('openModal', 'medicine.modals.schedule', {{ json_encode(['scheduleId' => $scheduleId]) }})">REAGENDAR</button>


    {{-- <button onclick="Livewire.emit('openModal', 'edit-user', {{ json_encode(['user' => $user->id]) }})">Edit User</button> --}}


    {{-- <button type="button" wire:click="openModal()"
class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">REAGENDAR
</button> --}}

</div>
