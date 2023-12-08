<div>
    <div class="p-4 sm:p-7">
        <div>
            <div class="mt-4 text-center">
                <h3 class="text-xl font-semibold leading-6 text-gray-800 capitalize dark:text-white" id="modal-title">
                    COMPLETAR INFORMACIÓN DE PAGO
                </h3>
                <div class="mt-6 grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-1 relative w-full group">
                        <x-input x-ref="payment" wire:model.lazy="reference_number" label="INGRESA LA LLAVE DE PAGO"
                            placeholder="INGRESE..." />
                    </div>
                    <div class="mt-1 relative w-full group">
                        <x-input wire:model.lazy="pay_date" id="date_pay" label="FECHA DE PAGO"
                            placeholder="INGRESE..." readonly />
                    </div>
                </div>
                <div class="mt-6 mb-6">
                    <label for="small" class="block text-sm text-gray-900 dark:text-white">ADJUNTA
                        EL COMPROBANTE DE PAGO</label>
                    <input type="file" wire:model="document_pay" x-ref="file" accept=".pdf"
                        class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                    <div class="float-left">
                        <div wire:loading wire:target="document_pay">
                            Subiendo...
                            <div style="color: #0404059a" class="la-ball-fall">
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
                <div class="flex justify-end items-center gap-x-2 p-5 sm:px-7">
                    <div class="float-right mt-6">
                        <x-button wire:click="save" label="ACEPTAR" blue right-icon="save-as" />
                    </div>
                    <div class="float-left mt-6">
                        <x-button wire:click="$emit('closeModal')" label="SALIR" silver />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        flatpickr("#date_pay", {
            dateFormat: "Y-m-d",
            disableMobile: "true",
            minDate: "2024-01-01",
            maxDate: "2024-01-31",
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
