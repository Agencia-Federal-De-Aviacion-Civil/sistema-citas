<div>
    <x-button
        wire:click="$emit('openModal', 'permissions.modals.create',{{ json_encode(['permissionId' => $permissionId]) }})"
        xs icon="pencil" cyan label="EDITAR" />
</div>
