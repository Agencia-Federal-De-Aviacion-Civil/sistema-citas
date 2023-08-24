<div>
    <div class="flex space-x-4">
        <x-button href="{{ route('afac.roles.edit', $rolesId) }}" xs icon="pencil" cyan label="EDITAR" />
        <form action="{{ route('afac.roles.destroy', $rolesId) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-button type="submit" xs icon="pencil" red label="ELIMINAR" />
        </form>
    </div>
</div>
