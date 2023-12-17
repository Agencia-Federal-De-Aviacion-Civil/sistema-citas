<div>
    <x-button
        wire:click="$emit('openModal', 'catalogue.modals.modal-new', {{ json_encode(['catalogsId' => $catalogsId]) }})"
        label="EDITAR" right-icon="pencil" xs info />
    {{-- <x-button
        wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['catalogsId' => $catalogsId]) }})"
        label="ELIMINAR" right-icon="trash" xs red /> --}}
</div>