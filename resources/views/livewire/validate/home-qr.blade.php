<div>
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">VERIFICACIÓN Y
                    VALIDACIÓN DE QR</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">Started on 29 Jan 2020</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        @foreach ($lingisticQuerys as $lingisticQuery)
            <div class="flex items-center justify-center px-5 py-5">
                <div
                    class="w-full max-w-xl px-5 pt-5 pb-10 mx-auto text-gray-800 bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:text-gray-50">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100">
                            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlnx="http://www.w.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <h3 class="py-6 text-2xl leading-6 font-medium text-gray-900">CITA CL-{{ $lingisticQuery->id }} VALIDA</h3>
                        <div class="mt-2 px-7 py-0">
                            {{-- <p class="text-sm text-gray-500">Account has been Successful registered.</p> --}}
                            <div class="w-full mb-10">
                                <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 uppercase">
                                   NOMBRE: {{ $lingisticQuery->linguisticReserve->linguisticUser->name . ' ' . $lingisticQuery->linguisticReserve->linguisticUser->UserParticipant->pluck('apParental')->first() . ' ' . $lingisticQuery->linguisticReserve->linguisticUser->UserParticipant->pluck('apMaternal')->first() }}
                                </p>
                                <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 uppercase">
                                    CURP: {{ $lingisticQuery->linguisticReserve->linguisticUser->userParticipant->pluck('curp')->first() }}
                                </p>
                                <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 uppercase">
                                    Tipo de Evaluación: {{ $lingisticQuery->linguisticReserve->linguisticTypeExam->name }}
                                </p>
                                <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 uppercase">
                                    Tipo de Licencia: {{ $lingisticQuery->linguisticReserve->linguisticTypeLicense->name }}
                                </p>
                                <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 uppercase">
                                    Referencia de pago: {{ $lingisticQuery->linguisticReserve->reference_number }}
                                </p>
                                <p class="text-lg title-font font-normal">Fecha y Hora:
                                    <p class="text-base font-semibold">
                                        {{ mb_strtoupper($dateConvertedFormatted) }} A LAS
                                        {{ $lingisticQuery->linguisticReserveSchedule->time_start }}
                                </p>
                            </div>
                        </div>
                        <div class="items-center px-4 py-0">
                            <button id="ok-btn" class="px-4 py-2 bg-blue-500 text-white
                                text-base font-medium rounded-md w-full
                                shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
