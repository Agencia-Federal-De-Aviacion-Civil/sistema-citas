<div>
    <x-button
    wire:click="$emit('openModal', 'headquarters.modals.create-update-schedule-modal',{{ json_encode(['actionId' => $actionId]) }})"
    xs icon="calendar" info label="EDITAR DIAS" />
</div>