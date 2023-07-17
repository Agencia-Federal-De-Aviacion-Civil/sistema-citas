<div>
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.create-update-modal',{{ json_encode(['userId' => $userId]) }})"
        xs right-icon="user-add" cyan label="EDITAR" />
    <x-button
        wire:click="$emit('openModal', 'headquarters.modals.create-update-responsible-modal',{{ json_encode(['userId' => $userId]) }})"
        xs right-icon="user-add" warning label="RESPONSABLES" />
</div>
