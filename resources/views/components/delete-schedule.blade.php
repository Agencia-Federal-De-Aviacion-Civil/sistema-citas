<div>
    <x-button
    wire:click="$emit('openModal', 'headquarters.modals.delete-schedule-modal',{{ json_encode(['deleteId' => $deleteId]) }})"
    xs icon="pencil" info label="HABILITAR DIA" />
</div>