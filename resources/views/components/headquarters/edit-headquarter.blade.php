<div>
    @if ($userHeadquarters->count())
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-modal-headquarter',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" cyan label="EDITAR" />
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-responsible-modal',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" green label="A CARGO" />
    @else
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-modal-headquarter',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" cyan label="EDITAR" />
        <x-badge flat negative xs label="NO DISPONIBLE" right-icon="user-remove" />
    @endif

</div>
