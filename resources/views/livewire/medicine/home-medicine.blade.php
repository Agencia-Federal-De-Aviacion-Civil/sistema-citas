<div>
    <div wire:offline.class="bg-red-300">
        NO TIENES INTERNET
    </div>
    <x-notifications position="top-bottom" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @if ($confirmModal)
        @include('livewire.medicine.modals.confirm')
    @endif
    @if ($modal)
        @include('livewire.medicine.modals.readyPdf')
    @endif
    @livewire('medicine.modals.modal-index')
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Generación
                    de
                    citas medicina de Aviación</h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <span tabindex="0" class="focus:outline-none">
                            {{ $dateNow }}
                        </span>
                        <p>Estado de la conexión: <span id="connection-status"></span></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form wire:submit.prevent="save">
                    </button>
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-4 w-4 text-blue-600 mt-1" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-gray-800 font-semibold">
                                    Verifique la información
                                </h3>
                                <div class="mt-2 text-sm text-gray-600">
                                    Por favor verifique que la sede seleccionada del pago corresponda con la de su
                                    preferencia para su evaluación médica.
                                </div>
                            </div>

                        </div>
                    </div>
                    <div x-cloak x-data="{
                        tipoExamen: @entangle('type_exam_id'),
                        question: @entangle('medicine_question_id'),
                        clasification: @entangle('type_class_id'),
                        typelicens: @entangle('clasification_class_id'),
                        reservedate: @entangle('dateReserve'),
                        reserschedule: @entangle('medicine_schedule_id'),
                        fileName: '',
                        typerevalora: '',
                        filereval: '',
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
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <div class="grid xl:grid-cols-4 xl:gap-6">
                                                    <div class="mt-1 relative z-0 w-full group">
                                                        <x-input x-ref="payment" wire:model.lazy="reference_number"
                                                            label="INGRESA LA LLAVE DE PAGO" placeholder="INGRESE..." />
                                                    </div>
                                                    <div class="mt-1 relative z-auto w-full group">
                                                        <x-input wire:model.lazy="pay_date" id="fecha-pago"
                                                            label="FECHA DE PAGO" placeholder="INGRESE..." readonly />
                                                    </div>
                                                    {{-- comprobante de pago --}}
                                                    <div class="mt-1 relative w-full group xl:col-span-2">
                                                        <label for="small"
                                                            class="block text-sm font-medium text-gray-900 dark:text-white">ADJUNTA
                                                            EL COMPROBANTE DE PAGO</label>
                                                        <label for="file-input" class="sr-only">Adjunta el
                                                            comprobante</label>
                                                        <input type="file" wire:model="document_pay" x-ref="file"
                                                            accept=".pdf" @change="fileName = $refs.file.files[0].name"
                                                            class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                                        <div class="float-left">
                                                            <div wire:loading wire:target="document_pay">
                                                                Subiendo...
                                                                <div style="color: #27559b9a" class="la-ball-fall">
                                                                    <div></div>
                                                                    <div></div>
                                                                    <div></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('document_pay')
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
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <label for="small"
                                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿QUE
                                                    TIPO DE EXÁMEN VAS A REALIZAR?</label>
                                                <select id="small" x-ref="tipoExamen" wire:model.lazy="type_exam_id"
                                                    wire:change="resetQuestions()" placeholder="seleccione..."
                                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="" selected>Seleccione...</option>
                                                    @foreach ($typeExams as $typeExam)
                                                        <option value="{{ $typeExam->id }}">{{ $typeExam->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type_exam_id')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- ADJUNTAR DOCUMENTOS PARA REVALORACIÓN --}}
                                        <div x-show="tipoExamen ==='3'" class="flex relative pb-6">
                                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                            </div>
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </div>
                                            {{-- AUTORIZCIÓN DE REVALORACIÓN --}}
                                            <div class="flex-grow pl-4">
                                                <label for="small"
                                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">ADJUNTAR
                                                    LA AUTORIZACIÓN POR PARTE DE LA AGENCIA FEDERAL DE AVIACIÓN
                                                    CIVIL</label>
                                                <label for="file-input" class="sr-only">Adjunta el
                                                    comprobante</label>
                                                <input type="file" wire:model="document_authorization"
                                                    x-ref="file2" accept=".pdf"
                                                    @change="filereval = $refs.file2.files[0].name"
                                                    class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                                <div class="float-left">
                                                    <div wire:loading wire:target="document_authorization">
                                                        Subiendo...
                                                        <div style="color: #27559b9a" class="la-ball-fall">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('document_authorization')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- paso revaloración --}}
                                        <div x-show="tipoExamen === '3' && filereval != '' "
                                            class="flex relative pb-6">
                                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                            </div>
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>

                                            </div>
                                            <div class="flex-grow pl-4">
                                                <label for="typerva"
                                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿QUE
                                                    TIPO DE REVALORACIÓN VAS A REALIZAR?</label>
                                                <select id="typerva" x-model="typerevalora"
                                                    wire:model.lazy="type_exam_revaloration_id" wire:change=""
                                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="0" selected>Seleccione...</option>
                                                    <option value="1" selected>INICIAL</option>
                                                    <option value="2" selected>RENOVACIÓN</option>
                                                </select>
                                                @error('type_exam_revaloration_id')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- paso2 --}}
                                        <div x-show="tipoExamen ==='1'||typerevalora==='1'"
                                            class="flex relative pb-6">
                                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                            </div>
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <label for="small"
                                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿SIGUES
                                                    ESTUDIANDO O VAS A ESTUDIAR?</label>
                                                <select id="small" x-ref="question"
                                                    wire:model.lazy="medicine_question_id"
                                                    wire:change="resetClasificationClass()"
                                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach ($userQuestions as $userQuestion)
                                                        <option value="{{ $userQuestion->id }}">
                                                            {{ $userQuestion->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- paso3 --}}
                                        <div x-show="tipoExamen === '1' && question === '1' || tipoExamen === '1' && question === '2' || typerevalora==='1'  && question > '0'"
                                            class="flex relative pb-6">
                                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                            </div>
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                                    <div class="mt-1 relative z-0 w-full group">
                                                        @if (!is_null($questionClassess))
                                                            <label for="small"
                                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPO
                                                                DE CLASE</label>
                                                            <select id="small" x-ref="clasification"
                                                                placeholder="seleccione..."
                                                                wire:model.lazy="type_class_id"
                                                                class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option value="">Seleccione...</option>
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
                                                    <div x-show="question === '1'">
                                                        <div class="mt-1 relative z-0 w-full group">
                                                            <label for="small"
                                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPO
                                                                DE
                                                                LICENCIA</label>
                                                            <select wire:model.lazy="clasification_class_id"
                                                                x-ref="typelicens"
                                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option value="">Seleccione...
                                                                </option>
                                                                @foreach ($clasificationClass as $clasification)
                                                                    <option value="{{ $clasification->id }}">
                                                                        {{ $clasification->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('clasification_class_id')
                                                                <span
                                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div x-show="question === '2'">
                                                        <div class="mt-4 relative z-auto w-full group">
                                                            <x-select label="TIPO DE LICENCIA"
                                                                x-model.lazy="typelicens"
                                                                placeholder="Seleccione uno o más..." :options="$clasificationClass"
                                                                option-label="name" option-value="id"
                                                                wire:model.lazy="clasification_class_id" multiselect />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div x-show="tipoExamen === '2' || typerevalora==='2'"
                                            class="flex relative pb-6">
                                            <div class="h-full w-10 absolute inset-0 flex items-center justify-center">
                                                <div class="h-full w-1 bg-gray-200 pointer-events-none"></div>
                                            </div>
                                            <div
                                                class="flex-shrink-0 w-10 h-10 rounded-full bg-sky-700 inline-flex items-center justify-center text-white relative z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                                    <div class="mt-1 relative z-0 w-full group">
                                                        @if (!is_null($questionClassess))
                                                            <label for="small"
                                                                class="block mb-2 text-base font-medium text-gray-900 dark:text-white">TIPO
                                                                DE CLASE</label>
                                                            <select id="small" x-ref="clasification"
                                                                placeholder="seleccione..."
                                                                wire:model.lazy="type_class_id"
                                                                class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                <option value="">Seleccione...</option>
                                                                @foreach ($typeRenovationExams as $typeRenovationExam)
                                                                    <option value="{{ $typeRenovationExam->id }}">
                                                                        {{ $typeRenovationExam->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('type_class_id')
                                                                <span
                                                                    class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                            @enderror
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div class="mt-4 relative z-auto w-full group">
                                                            <x-select label="TIPO DE LICENCIA"
                                                                x-model.lazy="typelicens" :options="$clasificationClass"
                                                                placeholder="Seleccione uno o más..."
                                                                option-label="name" option-value="id"
                                                                wire:model.lazy="clasification_class_id" multiselect />
                                                        </div>
                                                    </div>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                                </svg>
                                            </div>
                                            <div class="flex-grow pl-4">
                                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                                    <div class="text-base relative z-auto w-full mb-2 group">
                                                        <label for="small"
                                                            class="block mb-2 text-base font-medium text-gray-900 dark:text-white">ELIJA
                                                            LA SEDE</label>
                                                        <select id="small" x-ref="selec_sede"
                                                            wire:model.lazy="to_user_headquarters"
                                                            wire:change="searchDisabledDays()"
                                                            placeholder="seleccione..."
                                                            class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="" selected>Seleccione...</option>
                                                            @foreach ($sedes as $sede)
                                                                <option value="{{ $sede->headquarterUser->id }}">
                                                                    {{ $sede->headquarterUser->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <x-select label="ELIJA LA SEDE" placeholder="Selecciona"
                                                            x-ref="selec_sede" wire:model.lazy="to_user_headquarters" wire:change="searchDisabledDays()">
                                                            @foreach ($sedes as $sede)
                                                                <x-select.option
                                                                    label="{{ $sede->headquarterUser->name }}"
                                                                    value="{{ $sede->headquarterUser->id }}" />
                                                            @endforeach
                                                        </x-select> --}}
                                                    </div>
                                                    <div class="text-base relative z-auto w-full mt-2 group">
                                                        <x-input x-ref="reservedate" wire:model.lazy="dateReserve"
                                                            id="fecha-appointment" label="SELECCIONE FECHA"
                                                            placeholder="INGRESE..." readonly />
                                                    </div>
                                                    <div class="text-base relative z-auto w-full mt-2 group">
                                                        <label for="small"
                                                            class="block text-base font-medium text-gray-900 dark:text-white">SELECCIONE
                                                            HORA</label>
                                                        <select id="small" placeholder="seleccione..."
                                                            wire:model.lazy="medicine_schedule_id"
                                                            class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="">Seleccione...</option>
                                                            @foreach ($scheduleMedicines as $scheduleMedicine)
                                                                <option value="{{ $scheduleMedicine->id }}">
                                                                    {{ $scheduleMedicine->time_start }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('medicine_schedule_id')
                                                            <span
                                                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- paso6 --}}
                                        <div x-show="reserschedule > 0 && reservedate != 0" class="flex relative">
                                            {{-- <div class="flex relative">  $date --}}
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
                                                <div>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#fecha-pago", {
                dateFormat: "Y-m-d",
                disableMobile: "true",
                locale: {
                    weekdays: {
                        shorthand: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
            });
            // CITAS MEDICAS
            window.addEventListener('headquartersUpdated', event => {
                flatpickr("#fecha-appointment", {
                    // enableTime: true,
                    // time_24hr: true,
                    dateFormat: "Y-m-d",
                    // minTime: "07:00",
                    // maxTime: "10:59",
                    disableMobile: "true",
                    // minuteIncrement: 10,
                    minDate: "today",
                    //minDate: new Date(new Date().getFullYear(), 0, 1),
                    maxDate: new Date(new Date().getFullYear(), 11, 31),
                    disable: event.detail.disabledDaysFilter,
                    onDayCreate: function(dObj, dStr, fp, dayElem) {
                        /* if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6 || dayElem
                             .dateObj <= new Date()) {
                             dayElem.className += " flatpickr-disabled nextMonthDayflatpickr-disabled";
                         }*/
                        if (dayElem.dateObj.getDay() === 0 || dayElem.dateObj.getDay() === 6) {
                            dayElem.className +=
                                " flatpickr-disabled nextMonthDayflatpickr-disabled";
                        }
                    },
                    locale: {
                        weekdays: {
                            shorthand: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                                'Viernes',
                                'Sábado'
                            ],
                        },
                        months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago',
                                'Sep', 'Oct',
                                'Nov', 'Dic'
                            ],
                            longhand: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto',
                                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                            ],
                        },
                    },
                });
            });
        });

        function checkConnectionStatus() {
            if (!navigator.onLine) {
                document.getElementById('connection-status').innerText = 'Conexión lenta o inactiva';
            }
        }

        window.addEventListener('load', checkConnectionStatus);
        window.addEventListener('online', checkConnectionStatus);
        window.addEventListener('offline', checkConnectionStatus);
    </script>
</div>
