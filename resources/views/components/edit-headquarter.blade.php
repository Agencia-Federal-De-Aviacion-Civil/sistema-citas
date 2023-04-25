<div>
    {{ $userId }}
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.new-modal',{{ json_encode(['userId' => $userId]) }})"
        xs icon="pencil" cyan label="EDITAR" />
</div>
