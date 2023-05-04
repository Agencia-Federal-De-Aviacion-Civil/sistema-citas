   <div>
        <div>
            <x-notifications position="top-center" />
            <x-dialog z-index="z-50" blur="md" align="center" />
            <div class="relative py-6 lg:py-4">
                <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
                    alt="bg" />
                <div
                    class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div>
                        <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">CITAS AGENDADAS
                        </h4>
                        <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                            <li class="flex items-center mt-4 md:mt-0">
                                <div class="mr-1">
                                    <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                        alt="date">
                                </div>
                                <span tabindex="0" class="focus:outline-none">
                                    {{ $dateNow }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
                <div class="py-12">
                <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
                    <div class="mt-8 max-w-8xl mx-auto sm:px-6 lg:px-8">
                        <div class="ml-4 py-0 mr-4 uppercase text-sm">
                            <livewire:user-manager/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
