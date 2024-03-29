<div>
    @empty($privilegesId)
        <x-button class="mb-2"
            onclick="Livewire.emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId]) }})"
            right-icon="user-add" xs blue label="AGREGAR" />
    @else
        <x-button
            wire:click="$emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId]) }})"
            label="EDITAR" right-icon="pencil" xs blue />

        @canany(['super_admin.see.tabs.navigation'])
            <x-button
                wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['privilegesId' => $privilegesId]) }})"
                label="ELIMINAR" right-icon="trash" xs red />
        @endcanany
    @endempty

</div>
