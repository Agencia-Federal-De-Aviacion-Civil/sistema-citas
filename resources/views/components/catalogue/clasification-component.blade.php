<div>
    <x-button
        wire:click="$emit('openModal', 'catalogue.modals.modal-newclasification', {{ json_encode(['classificId' => $classificId]) }})"
        label="EDITAR" right-icon="pencil" xs info />
    {{-- <x-button
        wire:click="$emit('openModal', 'users.modals.modal-deleteclass', {{ json_encode(['classificId' => $classificId]) }})"
        label="ELIMINAR" right-icon="trash" xs red /> --}}
</div>