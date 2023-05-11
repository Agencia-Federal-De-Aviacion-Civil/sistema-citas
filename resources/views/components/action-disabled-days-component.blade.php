<div>
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.create-update-schedule-modal',{{ json_encode(['actionId' => $actionId]) }})"
        xs icon="calendar" info label="EDITAR DIAS" />
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.delete-schedule-modal',{{ json_encode(['actionId' => $actionId]) }})"
        xs icon="trash" red label="ELIMINAR" />
</div>
