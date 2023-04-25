<div>
    
    @empty($privilegesId)    
    <x-button
    class="mb-2"
    onclick="Livewire.emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => 0]) }})"
            right-icon="user-add" xs blue
            label="AGREGAR" />
    @else
    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId] ) }})"
    label="EDITAR" right-icon="pencil" xs warning />
     {{-- <x-button
    wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['privilegesId' => $privilegesId]) }})"
    label="ELIMINAR" xs red />     --}}
    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['privilegesId' => $privilegesId]) }})"
    label="ELIMINAR" right-icon="trash" xs red />
    @endempty

</div>