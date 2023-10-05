<div>
    <div class="p-4 sm:p-7">
        <div>
            <div class="mt-4 text-center">
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    {{-- {{ $reference_number_ext ? 'EXTENSIÓN DE CITA PARA EL USUARIO' . '' . $extensionCurp : 'AÑADIR EXTENSIÓN' }} --}}
                </h3>
                @if (count($medicineReservesExtension[0]->medicineReserveMedicineExtension) > 0)
                    @if ($medicineReservesExtension[0]->medicineReserveMedicineExtension[0]->reference_number_ext)
                        <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="type_exam" label="TIPO" placeholder="ESCRIBE..." readonly />
                            </div>
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="type_class" label="CLASE" placeholder="ESCRIBE..." readonly />
                            </div>
                        </div>
                        <div class="mt-6 grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="clasification_class" label="TIPO DE LICENCIA"
                                    placeholder="ESCRIBE..." readonly />
                            </div>
                        </div>
                        <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="reference_number_ext" label="INGRESA LA LLAVE DE PAGO"
                                    placeholder="INGRESE..." readonly />
                            </div>
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="date_reserve_ext" id="fecha-pago" label="FECHA DE PAGO"
                                    placeholder="INGRESE..." disabled />
                            </div>
                        </div>
                        <div class="mt-6 mb-12 float-right">
                            <button wire:click.prevent='viewPdf'
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">DESCARGAR
                                COMPROBANTE</button>
                        </div>
                    @else
                        <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="type_exam" label="TIPO" placeholder="ESCRIBE..." readonly />
                            </div>
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="type_class" label="CLASE" placeholder="ESCRIBE..." readonly />
                            </div>
                        </div>
                        <div class="mt-6 grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model="clasification_class" label="TIPO DE LICENCIA"
                                    placeholder="ESCRIBE..." readonly />
                            </div>
                        </div>
                       @if($this->is_external == 0) 
                        <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="reference_number_ext" label="INGRESA LA LLAVE DE PAGO"
                                    placeholder="INGRESE..." />
                            </div>
                            <div class="mt-1 relative w-full group">
                                <x-input wire:model.lazy="date_reserve_ext" id="fecha-pago" label="FECHA DE PAGO"
                                    placeholder="INGRESE..." />
                            </div>
                        </div>
                        <div class="mt-6 grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-1 relative w-full group">
                                <label for="file-input" class="text-sm text-left">ADJUNTA COMPROBANTE</label>
                                <input type="file" wire:model="document_ext_id"
                                    class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                <div class="float-left">
                                    <div wire:loading wire:target="document_ext_id">
                                        Subiendo...
                                        <div style="color: #27559b9a" class="la-ball-fall">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                @error('document_ext_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        @endif
                    @endif
                @else
                    <div x-data="{
                        tipoExamenExtension: @entangle('type_exam_id_extension'),
                        questionException: @entangle('medicine_question_ex_id'),
                        clasificationExtension: @entangle('clas_class_extension_id')
                    }">
                        <div class="mt-4 grid xl:grid-cols-1 xl:gap-6">
                            <div class="mt-1 relative z-0 w-full group">
                                <label for="selectExtension"
                                    class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿QUE
                                    TIPO DE EXTENSIÓN DESEA REALIZAR?</label>
                                <select id="selectExtension" wire:model.lazy="type_exam_id_extension"
                                    placeholder="seleccione..." x-ref="tipoExamenExtension"
                                    wire:change="resetClassExtensionId"
                                    class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Seleccione...</option>
                                    @foreach ($typeExams as $typeExam)
                                        <option value="{{ $typeExam->id }}">
                                            {{ $typeExam->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('')
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div x-show="tipoExamenExtension === '1'">
                            <div class="grid xl:grid-cols-1 xl:gap-6">
                                <div class="mt-1 relative z-0 w-full group">
                                    <label for="selectExtension"
                                        class="block mb-2 text-base font-medium text-gray-900 dark:text-white">¿SIGUE
                                        ESTUDIANDO O VA A ESTUDIAR?</label>
                                    <select id="questionExtension" wire:model.lazy="medicine_question_ex_id"
                                        placeholder="seleccione..." x-ref="questionException"
                                        wire:change="resetClassQuestion()"
                                        class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Seleccione...</option>
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
                        </div>
                        <div x-show="questionException > '0' || tipoExamenExtension === '2'">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="mt-1 relative z-0 w-full group">
                                    @if (!is_null($questionClassessExtension))
                                        <label for="small"
                                            class="block mb-2 text-base font-medium text-gray-900 dark:text-white">EXTENSIÓN
                                            TIPO DE CLASE</label>
                                        <select id="extensionTypeClassFirst" placeholder="seleccione..."
                                            wire:model.lazy="type_class_extension_id"
                                            class="block w-full p-2 mb-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Seleccione...</option>
                                            @foreach ($questionClassessExtension as $questionClassExtension)
                                                <option value="{{ $questionClassExtension->id }}">
                                                    {{ $questionClassExtension->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mt-1 relative z-0 w-full group">
                                    @if (!is_null($clasificationClassExtension))
                                        <label for="small"
                                            class="block mb-2 text-base font-medium text-gray-900 dark:text-white">EXTENSIÓN
                                            TIPO
                                            DE
                                            LICENCIA</label>
                                        <select wire:model.lazy="clas_class_extension_id"
                                            x-ref="clasificationExtension"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Seleccione...
                                            </option>
                                            @foreach ($clasificationClassExtension as $clasificationClassExt)
                                                <option value="{{ $clasificationClassExt->id }}">
                                                    {{ $clasificationClassExt->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('')
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($this->is_external == 0) 
                        <div x-show="clasificationExtension > '0'">
                            <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model.lazy="reference_number_ext" label="INGRESA LA LLAVE DE PAGO"
                                        placeholder="INGRESE..." />
                                </div>
                                <div class="mt-1 relative w-full group">
                                    <x-input wire:model.lazy="date_reserve_ext" id="fecha-pago" label="FECHA DE PAGO"
                                        placeholder="INGRESE..." />
                                </div>
                            </div>
                            <div class="mt-6 grid xl:grid-cols-1 xl:gap-6">
                                <div class="mt-1 relative w-full group">
                                    <label for="file-input" class="text-sm text-left">ADJUNTA COMPROBANTE</label>
                                    <input type="file" wire:model="document_ext_id"
                                        class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                                    <div class="float-left">
                                        <div wire:loading wire:target="document_ext_id">
                                            Subiendo...
                                            <div style="color: #27559b9a" class="la-ball-fall">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('document_ext_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                @endif
                <div class="flex items-center justify-between w-full gap-4 mt-6">

                    @if($this->id_type_class_extension != null && $this->ext_reference_number == null && $this->is_external==0 || $clas_class_extension_id!='')
                    <button wire:click.prevent="saveExtension()"
                    class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                    ACEPTAR
                    </button>
                    @else                    
                    
                    @endif
                    <button wire:click="$emit('closeModal')"
                        class="py-2 px-4  bg-white hover:bg-gray-100 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-indigo-500 w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        CERRAR
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
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
    </script>
</div>
