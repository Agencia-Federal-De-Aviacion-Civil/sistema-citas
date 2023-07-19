<div>
    @if ($userHeadquarters->count())
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-modal',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" cyan label="EDITAR" />
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-responsible-modal',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" green label="RESPONSABLES" />
    @else
        <x-button
            wire:click="$emit('openModal', 'headquarters.modals.create-update-modal',{{ json_encode(['userId' => $userId]) }})"
            xs right-icon="user-add" cyan label="EDITAR" />
        <x-badge flat negative md label="SIN RESPONSABLES" right-icon="user-remove" />
    @endif

</div>
