<div>
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Validación de
                    Citas Médicas</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">
                            {{ $dateNow }}
                        </span>
                        {{-- <p>Estado de la conexión: <span id="connection-status"></span></p> --}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center">
            <div
                class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-28 mb-3 rounded-full" src="{{ asset('images/check.png') }}"
                        alt="Bonnie image" />
                    <div class="mb-1 text-2xl font-semi-bold text-gray-900 dark:text-white">
                        {{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->name . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apParental')->first() . ' ' . $medicineReserves[0]->medicineReserveMedicine->medicineUser->UserParticipant->pluck('apMaternal')->first() }}
                    </div>
                    <span class="text-lg text-gray-500 dark:text-gray-400">
                        {{ $medicineReserves[0]->medicineReserveMedicine->medicineUser->userParticipant->pluck('curp')->first() }}</span>
                    <span class="text-lg text-gray-500 dark:text-gray-400">
                        {{ $medicineReserves[0]->medicineReserveMedicine->medicineTypeExam->name }}</span>
                    <span class="text-lg text-gray-500 dark:text-gray-400">
                        {{ $medicineReserves[0]->medicineReserveHeadquarter->name_headquarter }}</span>
                    <span class="text-lg text-gray-500 dark:text-gray-400">
                        {{ $medicineReserves[0]->dateReserve }}</span>
                    <span class="text-lg text-gray-500 dark:text-gray-400">
                        {{ $medicineReserves[0]->reserveSchedule->time_start }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
