<div>
    
    @empty($privilegesId)    
    <x-button
    class="mb-2"
    onclick="Livewire.emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => 0]) }})"
            right-icon="user-add" blue
            label="AÑADIR USUARIO" />
    @else
    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId] ) }})"
    label="EDITAR" xs warning />
     {{-- <x-button
    wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['privilegesId' => $privilegesId]) }})"
    label="ELIMINAR" xs red />     --}}
    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-delete', {{ json_encode(['privilegesId' => $privilegesId]) }})"
    label="ELIMINAR" xs red />
    @endempty

</div>