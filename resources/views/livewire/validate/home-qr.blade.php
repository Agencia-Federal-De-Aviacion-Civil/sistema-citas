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
        {{-- <div class="container mx-auto px-4 py-2 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-2 max-w-6xl mx-auto sm:px-6 lg:px-8"> --}}
        @foreach ($lingisticQuerys as $lingisticQuery)
            <div class="flex items-center justify-center px-5 py-5">
                <div
                    class="w-full max-w-xl px-5 pt-5 pb-10 mx-auto text-gray-800 bg-white rounded-lg shadow-lg dark:bg-gray-800 dark:text-gray-50">
                    <div class="w-full pt-1 pb-5 mx-auto -mt-16 text-center">
                        <a href="#" class="relative block">
                            <img alt="profil" src="{{ asset('images/validate.png') }}"
                                class="mx-auto object-cover rounded-full h-20 w-20 " />
                        </a>
                    </div>
                    <div class="w-full mb-10">
                        <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100">
                            {{ $lingisticQuery->linguisticReserve->linguisticUser->name . ' ' . $lingisticQuery->linguisticReserve->linguisticUser->UserParticipant->pluck('apParental')->first() . ' ' . $lingisticQuery->linguisticReserve->linguisticUser->UserParticipant->pluck('apMaternal')->first() }}
                        </p>
                        <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 font-extrabold">
                            {{ $lingisticQuery->linguisticReserve->linguisticUser->userParticipant->pluck('curp')->first() }}
                        </p>
                        <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100">
                            {{ $lingisticQuery->linguisticReserve->linguisticTypeExam->name }}
                        </p>
                        {{-- <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 font-extrabold">
                            {{ mb_strtoupper($dateConvertedFormatted) }}
                        <p class="px-5 text-base text-center text-gray-600 dark:text-gray-100 font-extrabold">
                            {{ $lingisticQuery->reserveSchedule->time_start }}</p> --}}
                    </div>
                    {{-- @if ($lingisticQuery->linguisticReserve->type_exam_id == 1)
                        <div class="w-full">
                            @if ($lingisticQuery->linguisticReserve->medicineInitial[0]->medicine_question_id == 1)
                                <p class="font-bold text-center text-blue-700 text-md">
                                    {{ $lingisticQuery->linguisticReserve->medicineInitial[0]->medicineInitialClasificationClass->name }}
                                </p>
                            @else
                                @foreach ($lingisticQuery->linguisticReserve->medicineInitial as $medicineEach)
                                    <ul class="font-bold text-center text-blue-700 text-md">
                                        <li>
                                            {{ $medicineEach->medicineInitialClasificationClass->name }}
                                        </li>
                                    </ul>
                                @endforeach
                            @endif
                            <p class="text-xs text-center text-gray-500 dark:text-gray-300">
                                {{ $lingisticQuery->linguisticReserve->medicineInitial[0]->medicineInitialTypeClass->name }}
                            </p>
                        </div>
                    @else
                        <div class="w-full">
                            <p class="font-bold text-center text-blue-700 text-md">
                                @foreach ($lingisticQuery->linguisticReserve->medicineRenovation as $renovation)
                                    {{ $renovation->renovationClasificationClass->name }}
                                @endforeach
                            </p>
                            <p class="text-xs text-center text-gray-500 dark:text-gray-300">
                                {{ $lingisticQuery->linguisticReserve->medicineRenovation[0]->renovationTypeClass->name }}
                            </p>
                        </div>
                    @endif --}}
                </div>
            </div>
        @endforeach
    </div>
    {{-- </div>
    </div> --}}

</div>
