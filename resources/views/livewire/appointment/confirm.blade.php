<div x-data="{ isOpen: true }" class="relative flex justify-center">
    <div x-show="isOpen" x-transition:enter="transition duration-300 ease-out"
        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave="transition duration-150 ease-in"
        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
        class="fixed inset-0 z-[60] overflow-y-auto bg-black bg-opacity-70" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-900 sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full sm:p-6">
                <div class="">
                    <div class="p-3 text-center">
                        <div
                            class="animate-pulse flex-shrink-0 w-24 h-24 bg-green-100 text-green-500 rounded-full inline-flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="px-6">
                        <h1
                            class="py-2  text-lg font-semibold text-center text-gray-800 capitalize xl:text-2xl lg:text-xl dark:text-white">
                            Verifica tus datos de la <span class="text-sky-700 ">Cita</span>
                        </h1>
                        {{-- <button wire:click="test()">GENERAR</button> --}}
                        <div class="flex justify-center mx-auto mt-2">
                            <span class="inline-block w-40 h-1 bg-sky-600 rounded-full"></span>
                            <span class="inline-block w-3 h-1 mx-1 bg-sky-600 rounded-full"></span>
                            <span class="inline-block w-1 h-1 bg-sky-600 rounded-full"></span>
                        </div>
                        <br>
                        <x-errors
                            title="Se han encontrado {errors} campo(s) vacio(s), por favor completalos para continuar..." />
                    </div>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-4 w-4 text-yellow-400 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm text-yellow-800 font-semibold">
                                    Una vez confirmada la cita no se podra modificar ningun dato.
                                </h3>
                            </div>
                        </div>
                    </div>
                    <br>
                    @foreach ($appointmentInfo as $appointment)
                        @if ($appointment->type_exam_id == 1)
                            <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                                <div class="sm:w-1/2 w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <p class="text-lg title-font font-normal">Folio:
                                        <p class="text-xl text-sky-800 font-semibold"> {{ $appointmentInfo[0]->id }}</p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="sm:w-full w-full">
                                        <div class="rounded flex p-0 h-full items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-lg title-font font-normal">Tipo de examen:
                                            <p class="text-xl font-semibold">
                                                {{ $appointment->appointmentTypeExam->name }}</p>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="sm:w-full w-full">
                                        <div class="rounded flex p-0 h-full items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-lg title-font font-normal">Tipo de clase:
                                            <p class="text-xl font-semibold">
                                                {{ $appointment->appointmentStudying[0]->studyingClass->name }}</p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        <p class="text-lg title-font font-normal">Tipo de Licencia:
                                        <p class="text-lg font-semibold">
                                            @if ($appointment->appointmentStudying[0]->user_question_id == 1)
                                                {{ $appointment->appointmentStudying[0]->studyingClasification->name }}
                                        </p>
                                    @elseif($appointment->appointmentStudying[0]->user_question_id == 2)
                                        @foreach ($typeStudyings as $typeStudying)
                                            <ul>
                                                <li>
                                                    {{ $typeStudying->studyingClasification->name }}
                                                </li>
                                            </ul>
                                        @endforeach
                        @endif

                        </p>
                        </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="sm:w-full w-full">
                <div class="rounded flex p-0 h-full items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-lg title-font font-normal">Referencia de pago:
                    <p class="text-lg font-semibold">
                        {{ $appointment->paymentConcept }}
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-52">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>

                        <p class="text-lg title-font font-normal">Fecha:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentSuccess->appointmentDate }} </p>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg title-font font-normal">hora:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentSuccess->appointmentTime }} AM</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-24">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>

                        <p class="text-lg title-font font-normal">Sede:
                        <p class="text-xl font-semibold">
                            {{ $userAppointment->appointmentSuccess->successHeadquarter->name }}
                        </p>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                </div>
            </div>
        </div>
        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-24">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <p class="text-lg title-font font-normal">Av. Nichupté, Manzana 10,
                            Edificio Laura,
                            512, 77535 Cancún, Q.R.
                            <a href="https://www.google.com/maps/place/Escuela+de+Aviaci%C3%B3n+Canc%C3%BAn/@21.1605443,-86.9006894,13z/data=!4m10!1m2!2m1!1sCanc%C3%BAn+Quintana+Roo+sacra+licencias+de+piloto!3m6!1s0x80d7af7aa2c04609:0x95d079877c3c9b8b!8m2!3d21.1397753!4d-86.8624571!15sCi5DYW5jw7puIFF1aW50YW5hIFJvbyBzYWNyYSBsaWNlbmNpYXMgZGUgcGlsb3RvWjAiLmNhbmPDum4gcXVpbnRhbmEgcm9vIHNhY3JhIGxpY2VuY2lhcyBkZSBwaWxvdG-SAQZzY2hvb2zgAQA!16s%2Fg%2F1tjjpqg7"
                                target="_blank" class="text-lg font-semibold text-sky-600">Consultar
                                mapa</a>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="flex mt-6 justify-center">
            <div class="w-full h-1 rounded-full bg-sky-600 inline-flex"></div>
        </div>
        <br>
    @elseif($appointment->type_exam_id == 2)
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="sm:w-1/2 w-full">
                <div class="rounded flex p-0 h-full items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-lg title-font font-normal">Folio:
                    <p class="text-xl text-sky-800 font-semibold">{{ $appointmentInfo[0]->id }}</p>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg title-font font-normal">Tipo de examen:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentTypeExam->name }}</p>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg title-font font-normal">Tipo de clase:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentRenovation[0]->renovationClass->name }}</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="sm:w-full w-full">
                <div class="rounded flex p-0 h-full items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-lg title-font font-normal">Tipo de Licencia:
                    <p class="text-lg font-semibold">
                        @foreach ($typeRenovations as $renovationsPilot)
                            <ul>
                                <li>{{ $renovationsPilot->renovationClasification->name }}</li>
                            </ul>
                        @endforeach
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="sm:w-full w-full">
                <div class="rounded flex p-0 h-full items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <p class="text-lg title-font font-normal">Referencia de pago:
                    <p class="text-lg font-semibold">
                        {{ $appointment->paymentConcept }}
                    </p>
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-52">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>

                        <p class="text-lg title-font font-normal">Fecha:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentSuccess->appointmentDate }}</p>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-lg title-font font-normal">hora:
                        <p class="text-xl font-semibold">
                            {{ $appointment->appointmentSuccess->appointmentTime }} AM</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-24">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>

                        <p class="text-lg title-font font-normal">Sede:
                        <p class="text-xl font-semibold">
                            {{ $userAppointment->appointmentSuccess->successHeadquarter->name }}
                        </p>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                </div>
            </div>
        </div>
        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
            <div class="grid xl:grid-cols-2 xl:gap-24">
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                        <p class="text-lg title-font font-normal">Av. Nichupté, Manzana 10,
                            Edificio Laura,
                            512, 77535 Cancún, Q.R.
                            <a href="https://www.google.com/maps/place/Escuela+de+Aviaci%C3%B3n+Canc%C3%BAn/@21.1605443,-86.9006894,13z/data=!4m10!1m2!2m1!1sCanc%C3%BAn+Quintana+Roo+sacra+licencias+de+piloto!3m6!1s0x80d7af7aa2c04609:0x95d079877c3c9b8b!8m2!3d21.1397753!4d-86.8624571!15sCi5DYW5jw7puIFF1aW50YW5hIFJvbyBzYWNyYSBsaWNlbmNpYXMgZGUgcGlsb3RvWjAiLmNhbmPDum4gcXVpbnRhbmEgcm9vIHNhY3JhIGxpY2VuY2lhcyBkZSBwaWxvdG-SAQZzY2hvb2zgAQA!16s%2Fg%2F1tjjpqg7"
                                target="_blank" class="text-lg font-semibold text-sky-600">Consultar
                                mapa</a>
                        </p>
                    </div>
                </div>
                <div class="sm:w-full w-full">
                    <div class="rounded flex p-0 h-full items-center">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="flex mt-6 justify-center">
            <div class="w-full h-1 rounded-full bg-sky-600 inline-flex"></div>
        </div>
        <br>
        @endif
        <div class="mt-5 sm:flex sm:items-center sm:-mx-2">
            <button wire:click.prevent="deleteAppointment({{ $appointmentInfo[0]->id }})"
                class="w-full px-4 py-2 text-sm text-center font-medium tracking-wide text-gray-700 transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                CANCELAR CITA
            </button>
            @endforeach
            <div wire:loading.delay.shortest wire:target="deleteAppointment">
                <div
                    class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                    <div style="color: #0061cf" class="la-line-spin-clockwise-fade-rotating la-3x">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <button wire:click.prevent="closeModalFinish"
                class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 focus:ring-opacity-40">
                CONCLUIR CITA
            </button>
            <div wire:loading.delay.shortest wire:target="closeModalFinish">
                <div
                    class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                    <div style="color: #0061cf" class="la-line-spin-clockwise-fade-rotating la-3x">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
