<div>
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.create-update-modal',{{ json_encode(['userId' => $userId]) }})"
        xs icon="pencil" cyan label="EDITAR" />
</div>
