<div>
    <x-button
        wire:click="$emit('openModal', 'catalogue.modals.modal-newtypexam', {{ json_encode(['typexamsId' => $typexamsId]) }})"
        label="EDITAR" right-icon="pencil" xs info />
    {{-- <x-button
        wire:click="$emit('openModal', 'users.modals.modal-deleteclass', {{ json_encode(['typexamsId' => $typexamsId]) }})"
        label="ELIMINAR" right-icon="trash" xs red /> --}}
</div>