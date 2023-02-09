<div>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @if ($confirmModal)
        @include('livewire.appointment.confirm')
    @endif
    @if ($modal)
        @include('livewire.appointment.readyPdf')
    @endif
    @livewire('home.modal-index')
    <form wire:submit.prevent="save">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Generación de cita
            </h1>
            <div class="flex mx-auto mt-2">
                <span class="inline-block w-60 h-1 bg-sky-700 rounded-full"></span>
                <span class="inline-block w-3 h-1 mx-1 bg-sky-700 rounded-full"></span>
                <span class="inline-block w-1 h-1 bg-sky-700 rounded-full"></span>
            </div>
        </div>
        </button>
        <div x-data="{
            tipoExamen: @entangle('type_exam_id'),
            question: @entangle('user_question_id'),
            clasification: @entangle('type_class_id'),
            typelicens: @entangle('clasification_class_id'),
            selec_sede: @entangle('headquarter_id'),
            fileName: '',
        }">
            {{-- estep --}}
            <section class="text-gray-600 body-font">
                <div class="container md:px-2 lg:px-5 py-0 mx-auto flex flex-wrap">
                    <div class="flex flex-wrap w-full">
                        <div class="lg:w-full md:w-full md:pr-10 md:py-6">
                            <div class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="grid xl:grid-cols-3 xl:gap-6">
                                        <div class="mt-1 relative z-0 w-full group">
                                            <label for="small"
                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">INGRESA
                                                LA REFERENCIA DE PAGO</label>
                                            <input type="text" x-ref="payment" wire:model.lazy="paymentConcept"
                                                class="py-2 px-4 block w-full font-bold	border-gray-200 rounded-md text-base focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                                                placeholder="Referencia de pago">
                                            @error('paymentConcept')
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mt-1 relative z-auto w-full group">
                                            <label for="small"
                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">INGRESA
                                                LA FECHA DE PAGO</label>
                                            <x-datetime-picker class="py-2.5" placeholder="Ingrese..."
                                                without-time="false" parse-format="YYYY-MM-DD"
                                                display-format="DD-MM-YYYY" wire:model.defer="paymentDate" />
                                        </div>

                                        <div class="mt-1 relative z-0 w-full group">
                                            <label for="small"
                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">ADJUNTA
                                                EL COMPROBANTE DE PAGO</label>
                                            <label for="file-input" class="sr-only">Adjunta el comprobante</label>
                                            <input type="file" wire:model="document" x-ref="file"
                                                @change="fileName = $refs.file.files[0].name"
                                                class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                            <div class="float-left">
                                                <div wire:loading wire:target="document">Subiendo...
                                                    <div style="color: #27559b9a" class="la-ball-fall">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('document')
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- paso1 --}}
                            <div x-show="fileName != ''" class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <label for="small"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿QUE TIPO
                                        DE
                                        EXÁMEN VAS
                                        A REALIZAR?</label>
                                    <select id="small" x-ref="tipoExamen" wire:model.lazy="type_exam_id"
                                        placeholder="seleccione..."
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Seleccione...</option>
                                        @foreach ($typeExamens as $typeExam)
                                            <option value="{{ $typeExam->id }}">{{ $typeExam->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('type_exam_id')
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- paso2 --}}
                            <div x-show="tipoExamen ==='1'" class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <label for="small"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿SIGUES
                                        ESTUDIANDO?</label>
                                    <select id="small" x-ref="question" wire:model.lazy="user_question_id"
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Seleccione...</option>
                                        @foreach ($questions as $question)
                                            <option value="{{ $question->id }}">{{ $question->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_question_id')
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- paso3 --}}
                            <div x-show="question === '1' || question === '2'||tipoExamen ==='2'"
                                class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="grid xl:grid-cols-2 xl:gap-6">
                                        <div x-show="question === '1' || question === '2'"
                                            class="mt-1 relative z-0 w-full group">
                                            @if (!is_null($questionClassess))
                                                <label for="small"
                                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPO
                                                    DE
                                                    CLASE</label>
                                                <select id="small" x-ref="clasification"
                                                    placeholder="seleccione..." wire:model.lazy="type_class_id"
                                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="0">Seleccione...</option>
                                                    @foreach ($questionClassess as $questionClass)
                                                        <option value="{{ $questionClass->id }}">
                                                            {{ $questionClass->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type_class_id')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>
                                        <div x-show="tipoExamen ==='2'">
                                            <div class="mt-1 relative z-0 w-full group">
                                                @if (!is_null($typeClasses))
                                                    <label for="small"
                                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPO
                                                        DE
                                                        CLASE</label>
                                                    <select id="small" wire:model.lazy="type_class_id"
                                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="0">Seleccione...</option>
                                                        @foreach ($typeClasses as $typeClass)
                                                            <option value="{{ $typeClass->id }}">
                                                                {{ $typeClass->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('type_class_id')
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        {{-- paso4  --}}
                                        <div x-show="clasification === '1' || clasification === '2' || clasification === '3' ||  clasification === '4' || clasification === '5'
                                            || clasification === '6'"
                                            class="mt-4 relative z-0 w-full group">
                                            @if (!is_null($clasificationClass))
                                                <label for="small"
                                                    class="flex block w-full bg-white lg:text-base xs:text-xl focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">TIPO
                                                    DE LICENCIA
                                                    <a tabindex="0" role="link" aria-label="tooltip 2"
                                                        class="focus:outline-none focus:ring-gray-300 rounded-full focus:ring-offset-2 focus:ring-2 focus:bg-gray-200 relative mt-0 md:mt-0 px-4"
                                                        onmouseover="showTooltip(1)" onfocus="showTooltip(1)"
                                                        onmouseout="hideTooltip(1)">
                                                        <div class="cursor-pointer text-sky-700">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                        <div id="tooltip1" role="tooltip"
                                                            class="z-20 -mt-20 w-64 relative transition duration-150 ease-in-out left-0 ml-8 shadow-lg bg-white p-4 hidden">
                                                            <svg class="absolute left-0 -ml-2 bottom-0 top-0 h-full"
                                                                width="9px" height="16px" viewBox="0 0 9 16"
                                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                <g id="Page-1" stroke="none" stroke-width="1"
                                                                    fill="none" fill-rule="evenodd">
                                                                    <g id="Tooltips-"
                                                                        transform="translate(-874.000000, -1029.000000)"
                                                                        fill="#FFFFFF">
                                                                        <g id="Group-3-Copy-16"
                                                                            transform="translate(850.000000, 975.000000)">
                                                                            <g id="Group-2"
                                                                                transform="translate(24.000000, 0.000000)">
                                                                                <polygon id="Triangle"
                                                                                    transform="translate(4.500000, 62.000000) rotate(-90.000000) translate(-4.500000, -62.000000) "
                                                                                    points="4.5 57.5 12.5 66.5 -3.5 66.5">
                                                                                </polygon>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <p class="text-ms font-bold text-gray-800 pb-1">
                                                                INSTRUCCIONES
                                                            </p>
                                                            <p class="text-ms leading-4 text-gray-600 pb-3">Puedes
                                                                seleccionar uno o más tipos de licencias
                                                            </p>
                                                        </div>
                                                    </a>
                                                </label>
                                                @if ($typeexamid == 1)
                                                    <select wire:model.lazy="clasification_class_id"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                        <option value="" selected>Seleccione...</option>
                                                        @foreach ($clasificationClass as $clasification)
                                                            <option value="{{ $clasification->id }}">
                                                                {{ $clasification->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @if ($typeexamid == 2)
                                                    <div class="z-50">
                                                        <x-select wire:model.lazy="clasification_class_id"
                                                            placeholder="Seleccione..." multiselect>
                                                            <x-select.option label="Seleccione..." selected />
                                                            @foreach ($clasificationClass as $clasification)
                                                                <x-select.option label="{{ $clasification->name }}"
                                                                    value="{{ $clasification->id }}" />
                                                            @endforeach
                                                        </x-select>
                                                    </div>
                                                @endif
                                                {{-- @error('clasification_class_id')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror --}}
                                            @endif
                                        </div>
                                        {{--  --}}
                                    </div>
                                </div>
                            </div>
                            {{-- paso5 --}}
                            <div x-show="typelicens > '0'" class="flex relative pb-6">
                                <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                    <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                </div>
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="grid xl:grid-cols-3 xl:gap-6">
                                        <div class="text-base relative z-auto w-full mb-2 group">
                                            <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                                x-ref="selec_sede" wire:model.lazy="headquarter_id">
                                                @foreach ($sedes as $sede)
                                                    <x-select.option label="{{ $sede->name }}"
                                                        value="{{ $sede->id }}" />
                                                @endforeach
                                            </x-select>
                                        </div>
                                        <div class="text-base relative z-auto w-full mb-2 group">
                                            <x-datetime-picker label="SELECCIONE FECHA" placeholder="Seleccione..."
                                                without-time="false" parse-format="YYYY-MM-DD"
                                                display-format="DD-MM-YYYY" wire:model.defer="appointmentDate" />
                                        </div>

                                        <div class="text-base relative z-auto w-full mb-2 group">
                                            <x-select label="SELECCIONE HORA" placeholder="Seleccione..."
                                                wire:model.defer="appointmentTime">
                                                {{-- @foreach ($var as $user_appointment_succes)
                                                
                                                @endforeach --}}
                                                <x-select.option label="7:00 AM" value="7:00" />
                                                <x-select.option label="8:00 AM" value="8:00" />
                                                <x-select.option label="9:00 AM" value="9:00" />
                                                <x-select.option label="10:00 AM" value="10:00" />
                                            </x-select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- paso6 --}}
                            <div x-show="selec_sede > '0'" class="flex relative">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full bg-green-500 inline-flex items-center justify-center text-white relative z-10">
                                    <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                        viewBox="0 0 24 24">
                                        <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                        <path d="M22 4L12 14.01l-3-3"></path>
                                    </svg>
                                </div>
                                <div class="flex-grow pl-4">
                                    <div class="">
                                        <button
                                            class="px-3 py-2 text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                                            GENERAR CITA
                                        </button>
                                        <div wire:loading.delay.shortest wire:target="save">
                                            <div
                                                class="flex justify-center bg-gray-200 z-40 h-full w-full fixed top-0 left-0 items-center opacity-75">
                                                <div style="color: #0061cf"
                                                    class="la-line-spin-clockwise-fade-rotating la-3x">
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
            </section>
            {{-- estep --}}
        </div>
    </form>
    <script>
        function showTooltip(flag) {
            switch (flag) {
                case 1:
                    document.getElementById("tooltip1").classList.remove("hidden");
                    break;
            }
        }

        function hideTooltip(flag) {
            switch (flag) {
                case 1:
                    document.getElementById("tooltip1").classList.add("hidden");
                    break;
            }
        }
    </script>
</div>
