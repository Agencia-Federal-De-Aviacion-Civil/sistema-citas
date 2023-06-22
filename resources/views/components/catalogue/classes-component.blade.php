<div>
    <x-button
        wire:click="$emit('openModal', 'catalogue.modals.modal-newclass', {{ json_encode(['classId' => $classId]) }})"
        label="EDITAR" right-icon="pencil" xs info />
    {{-- <x-button
        wire:click="$emit('openModal', 'users.modals.modal-deleteclass', {{ json_encode(['classId' => $classId]) }})"
        label="ELIMINAR" right-icon="trash" xs red /> --}}
</div>