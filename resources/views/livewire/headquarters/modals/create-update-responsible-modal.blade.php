<div>
    <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-input wire:model.lazy="name" label="NOMBRE DEL RESPONSABLE" placeholder="ESCRIBE..." />
                </div>
                <div class="mt-4 relative w-full group">
                    <x-input wire:model.lazy="email" label="CORREO" placeholder="ESCRIBE..." />
                </div>
            </div>
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="mt-4 relative w-full group">
                    <x-inputs.password wire:model.lazy="passwordConfirmation" label="CONTRASEÑA" />
                </div>
                <div class="mt-4 relative w-full group">
                    <x-inputs.password wire:model.lazy="password" label="CONFIRMAR CONTRASEÑA" />
                </div>
            </div>
            @if ($queryResponsibles->count())
                <div class="py-8">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    NOMBRE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    EMAIL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queryResponsibles as $queryResponsible)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $queryResponsible->userHeadquarterUser->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $queryResponsible->userHeadquarterUser->email }}
                                    </td>
                                    <td>
                                        <x-button wire:click.prevent="delete({{ $queryResponsible->id }})"
                                            label="ELIMINAR" xs red right-icon="trash" />
                                    </td>
                                </tr>
                        </tbody>
            @endforeach
            </table>
        </div>
    @else
        @endif
        <div class="flex items-center justify-between w-full gap-4 mt-12">
            <x-button wire:click.prevent="save()" label="GUARDAR" blue right-icon="save-as" />
            <x-button wire:click.prevent="$emit('closeModal')" label="SALIR" right-icon="login" />
        </div>
    </div>
</div>
</div>
