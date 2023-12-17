<div>
    <div class="p-4 m-auto bg-white shadow-lg rounded-2xl dark:bg-gray-800">
        <div class="w-full h-full text-center">
            <div class="flex flex-col justify-between h-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-20 h-20 m-auto mt-4 text-indigo-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
                <p class="mt-4 text-xl font-bold text-gray-500 dark:text-gray-200">
                    {{ $nameHeadquarter[0]->name_headquarter }}
                </p>
                <div class="mt-6">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    NOMBRE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    EMAIL
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queryResponsibles as $queryResponsible)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">
                                        {{ $queryResponsible->userHeadquarterUserParticipant->userParticipantUser->name . ' ' . $queryResponsible->userHeadquarterUserParticipant->apParental . ' ' . $queryResponsible->userHeadquarterUserParticipant->apMaternal }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $queryResponsible->userHeadquarterUserParticipant->userParticipantUser->email }}
                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="flex items-center justify-between w-full gap-4 mt-12">
                    <button wire:click="$emit('closeModal')"
                        class="py-2 px-4  bg-gray-50 hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        CERRAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
