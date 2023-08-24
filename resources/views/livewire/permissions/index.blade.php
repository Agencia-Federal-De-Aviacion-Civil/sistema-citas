<div>
    <x-notifications position="top-bottom" />
    <div class="mb-6">
        <x-button wire:click="$emit('openModal', 'permissions.modals.create-update-modal')"
            icon="pencil" primary label="AÑADIR" />
    </div>
    {{-- <livewire:permission-table /> --}}
</div>
