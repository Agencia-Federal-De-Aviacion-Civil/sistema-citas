<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
{{-- 
    <x-button label="EDITAR" xs warning />
    <x-button label="ELIMINAR" xs red /> --}}
    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId] ) }})"
    label="EDITAR" xs warning />

    <x-button
    wire:click="$emit('openModal', 'users.modals.modal-new', {{ json_encode(['privilegesId' => $privilegesId]) }})"
    label="ELIMINAR" xs red />    

</div>