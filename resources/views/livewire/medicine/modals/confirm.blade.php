<div class="relative flex justify-center">
    <div class="fixed inset-0 z-[60] overflow-y-auto bg-black bg-opacity-70" aria-labelledby="modal-title" role="dialog"
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
                    @if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 1)
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-1/2 w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">FOLIO:
                                    <p class="text-xl text-sky-800 font-semibold">
                                        @if ($idAppointmentFull == 0)
                                            <p>FOLIO DE CITA: <b>MED-{{ $medicineReserves[0]->id }}</b></p>
                                        @else
                                            <p>FOLIO DE CITA: <b>MED-EXT-{{ $medicineReserves[0]->id }}</b></p>
                                        @endif
                                    </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE EXAMEN:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}
                                        </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE CLASE:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
                                        </p>
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
                                    <p class="text-lg title-font font-normal">TIPO DE LICENCIA:
                                    <p class="text-lg font-semibold">
                                        @foreach ($medicineReserves as $medicineReserve)
                                            @if ($medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicine_question_id == 1)
                                                {{ $medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name }}
                                            @else
                                                @foreach ($medicineReserve->medicineReserveMedicine->medicineInitial as $medicineEach)
                                                    <ul>
                                                        <li>
                                                            {{ $medicineEach->medicineInitialClasificationClass->name }}
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- AQUI VAN LAS EXTEPCIONES --}}
                        @if ($medicineReserves[0]->medicineReserveMedicineExtension->count() > 0)
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
                                            <p class="text-lg title-font font-normal">EXT TIPO DE EXAMEN:
                                            <p class="text-xl font-semibold">
                                                {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->typeClassTypeExam->name }}
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="sm:w-full w-full">
                                        <div class="rounded flex p-0 h-full items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-lg title-font font-normal">EXT TIPO DE CLASE:
                                            <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->name }}
                                            </p>
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
                                        <p class="text-lg title-font font-normal">EXT TIPO DE LICENCIA:
                                        <p class="text-lg font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionClasificationClass->name }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-full w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">REFERENCIA DE PAGO:
                                    <p class="text-lg font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicine->reference_number }}
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">FECHA Y HORA:
                                        <p class="text-xl font-semibold">
                                            {{ mb_strtoupper($dateConvertedFormatted) }} A LAS
                                            {{ $medicineReserves[0]->reserveSchedule->time_start }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="sm:w-full w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">hora:
                                    <p class="text-xl font-semibold">
                                    </p>
                                    </p>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">SEDE:
                                        <p class="text-lg font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="sm:w-full w-full">
                                </div>
                            </div>
                        </div>
                        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <p class="text-lg title-font font-normal">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->direction }}"
                                            <a href="{{ $medicineReserves[0]->medicineReserveHeadquarter->url }}"
                                                target="_blank" class="text-lg font-semibold text-sky-600">CONSULTAR MAPA</a>
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
                    @elseif($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 2)
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-1/2 w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">FOLIO:
                                    <p class="text-xl text-sky-800 font-semibold">
                                        MED-{{ $medicineReserves[0]->id }}
                                    </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE EXAMEN:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}
                                        </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE CLASE:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
                                        </p>
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
                                    <p class="text-lg title-font font-normal">TIPO DE LICENCIA:
                                    <p class="text-lg font-semibold">
                                        @foreach ($medicineReserves[0]->medicineReserveMedicine->medicineRenovation as $renovationEach)
                                            <ul>
                                                <li>
                                                    {{ $renovationEach->renovationClasificationClass->name }}
                                                </li>
                                            </ul>
                                        @endforeach
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @if ($medicineReserves[0]->medicineReserveMedicineExtension->count() > 0)
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
                                        <p class="text-lg title-font font-normal">EXT TIPO DE EXAMEN:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->typeClassTypeExam->name }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg title-font font-normal">EXT TIPO CLASE:
                                        <p class="text-xl font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionTypeClass->name }}
                                        </p>
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
                                    <p class="text-lg title-font font-normal">EXT TIPO DE LICENCIA:
                                    <p class="text-lg font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicineExtension[0]->extensionClasificationClass->name }}
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-full w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">REFERENCIA DE PAGO:
                                    <p class="text-lg font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicine->reference_number }}
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">FECHA Y HORA:
                                        <p class="text-xl font-semibold">
                                            {{ mb_strtoupper($dateConvertedFormatted) }} A LAS
                                            {{ $medicineReserves[0]->reserveSchedule->time_start }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg title-font font-normal">hora:
                                        <p class="text-xl font-semibold">
                                            {{-- {{ $appointment->appointmentSuccess->appointmentTime }} AM --}}
                                {{-- </p>
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">SEDE:
                                        <p class="text-lg font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="sm:w-full w-full">
                                </div>
                            </div>
                        </div>
                        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <p class="text-lg title-font font-normal">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->direction }}"
                                            <a href="{{ $medicineReserves[0]->medicineReserveHeadquarter->url }}"
                                                target="_blank" class="text-lg font-semibold text-sky-600">CONSULTAR MAPA</a>
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
                    @elseif($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 4)
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-1/2 w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">FOLIO:
                                    <p class="text-xl text-sky-800 font-semibold">
                                        MED-{{ $medicineReserves[0]->id }}
                                    </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE EXAMEN:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}
                                        </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE CLASE:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
                                        </p>
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
                                    <p class="text-lg title-font font-normal">TIPO DE LICENCIA:
                                    <p class="text-lg font-semibold">
                                        @foreach ($medicineReserves[0]->medicineReserveMedicine->medicineRenovation as $renovationEach)
                                            <ul>
                                                <li>
                                                    {{ $renovationEach->renovationClasificationClass->name }}
                                                </li>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">REFERENCIA DE PAGO:
                                    <p class="text-lg font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicine->reference_number }}
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">FECHA Y HORA:
                                        <p class="text-xl font-semibold">
                                            {{ mb_strtoupper($dateConvertedFormatted) }} A LAS
                                            {{ $medicineReserves[0]->reserveSchedule->time_start }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-lg title-font font-normal">hora:
                                        <p class="text-xl font-semibold">
                                            {{-- {{ $appointment->appointmentSuccess->appointmentTime }} AM --}}
                                {{-- </p>
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">SEDE:
                                        <p class="text-lg font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="sm:w-full w-full">
                                </div>
                            </div>
                        </div>
                        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <p class="text-lg title-font font-normal">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->direction }}"
                                            <a href="{{ $medicineReserves[0]->medicineReserveHeadquarter->url }}"
                                                target="_blank" class="text-lg font-semibold text-sky-600">CONSULTAR MAPA</a>
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
                    @else
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div class="sm:w-1/2 w-full">
                                <div class="rounded flex p-0 h-full items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <p class="text-lg title-font font-normal">FOLIO:
                                    <p class="text-xl text-sky-800 font-semibold">
                                        MED-{{ $medicineReserves[0]->id }}
                                    </p>
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
                                        <p class="text-lg title-font font-normal">TIPO DE EXAMEN:
                                        <p class="text-xl font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}
                                        </p>
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
                                        {{-- dependiendo de revaloración --}}
                                        @if ($medicineReserves[0]->medicineReserveMedicine->type_exam_id == 5)
                                            <p class="text-lg title-font font-normal">
                                                Revaloración post Flexibilidad
                                            </p>
                                        @else
                                            <p class="text-lg title-font font-normal">Tipo de revaloración:
                                            <p class="text-xl font-semibold">
                                                {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->RevaluationTypeExam->name }}
                                            </p>
                                            </p>
                                        @endif
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
                                    <p class="text-lg title-font font-normal">TIPO DE CLASE:
                                    <p class="text-lg font-semibold">
                                        @if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1)
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }}
                                        @else
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name }}
                                        @endif
                                        {{-- @foreach ($medicineReserves as $medicineReserve)
                                            @if ($medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicine_question_id == 1)
                                                {{ $medicineReserve->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name }}
                                            @else
                                                @foreach ($medicineReserve->medicineReserveMedicine->medicineInitial as $medicineEach)
                                                    <ul>
                                                        <li>
                                                            {{ $medicineEach->medicineInitialClasificationClass->name }}
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            @endif
                                        @endforeach --}}
                                    </p>
                                    </p>
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
                                    <p class="text-lg title-font font-normal">TIPO DE LICENCIA:
                                    <p class="text-lg font-semibold">
                                        @if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1)
                                            {{-- REVALORACIÓN INICIAL --}}
                                            @if ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->medicine_question_id == 1)
                                                {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name }}
                                            @else
                                                @foreach ($medicineReserves[0]->medicineReserveMedicine->medicineRevaluation as $initialEach)
                                                    {{ $initialEach->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name }}
                                                @endforeach
                                                {{-- TODO FALTA TERMINAR EL FOREACH DE INICIAL CUANDO EL USUARIO SELEECIONA QUE NO --}}
                                            @endif
                                        @else
                                            {{-- REVALORACIÓN RENOVACIÓN --}}
                                            {{ $medicineReserves[0]->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name }}
                                        @endif
                                    </p>
                                    </p>
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
                                    <p class="text-lg title-font font-normal">REFERENCIA DE PAGO:
                                    <p class="text-lg font-semibold">
                                        {{ $medicineReserves[0]->medicineReserveMedicine->reference_number }}
                                    </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap sm:mx-auto sm:mb-4 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">FECHA Y HORA:
                                        <p class="text-xl font-semibold">
                                            {{ mb_strtoupper($dateConvertedFormatted) }} A LAS
                                            {{ $medicineReserves[0]->reserveSchedule->time_start }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-8 flex flex-wrap sm:mx-auto sm:-mb-8 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="text-sky-700 w-6 h-6 flex-shrink-0 mr-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>

                                        <p class="text-lg title-font font-normal">SEDE:
                                        <p class="text-lg font-semibold">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}
                                        </p>
                                        </p>
                                    </div>
                                </div>
                                <div class="sm:w-full w-full">
                                </div>
                            </div>
                        </div>
                        <div class="p-y-6 px-6 flex flex-wrap sm:mx-auto sm:-mb-2 -mx-2">
                            <div>
                                <div class="sm:w-full w-full">
                                    <div class="rounded flex p-0 h-full items-center">
                                        <p class="text-lg title-font font-normal">
                                            {{ $medicineReserves[0]->medicineReserveHeadquarter->direction }}"
                                            <a href="{{ $medicineReserves[0]->medicineReserveHeadquarter->url }}"
                                                target="_blank" class="text-lg font-semibold text-sky-600">CONSULTAR MAPA</a>
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
                        <button wire:click.prevent="delete({{ $medicineReserves[0]->id }})" {{-- deleteAppointment({{ $appointmentInfo[0]->id }}) --}}
                            class="w-full px-4 py-2 text-sm text-center font-medium tracking-wide text-gray-700 transition-colors duration-300 transform border border-gray-200 rounded-md sm:w-1/2 sm:mx-2 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800 hover:bg-gray-100 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-40">
                            CANCELAR CITA
                        </button>
                        {{-- @endforeach --}}
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
                        <button wire:click.prevent="openModalPdf"
                            class="w-full px-4 py-2 mt-4 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-sky-600 rounded-md sm:mt-0 sm:w-1/2 sm:mx-2 hover:bg-sky-700 focus:outline-none focus:ring focus:ring-sky-300 focus:ring-opacity-40">
                            AGENDAR CITA
                        </button>
                        <div wire:loading.delay.shortest wire:target="openModalPdf">
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
