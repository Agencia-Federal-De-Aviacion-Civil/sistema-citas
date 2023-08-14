<div>
    @if ($modalQr)
        @include('livewire.medicine.certificate-qr.modals.certificate-qr-modal')
    @endif
    <x-dialog z-index="z-50" blur="md" align="center" />
    <div class="relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div
            class="z-10 relative container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white">Validación de
                    Licencias</h4>
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
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid xl:grid-cols-2 xl:gap-6">
                    <div class="mt-1 relative z-0 w-full group">
                        <x-input right-icon="user" wire:model.lazy="search" label="CURP"
                            placeholder="INGRESE CURP PARA BUSCAR" />
                        <button wire:click="$emitSelf('searchUsers')"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg ml-2">Buscar</button>
                    </div>
                </div>
                @if ($userDetails)
                    <div class="grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user"
                                value="{{ $userDetails->medicineReserveFromUser->name . ' ' . $userDetails->medicineReserveFromUser->UserParticipant[0]->apParental . ' ' . $userDetails->medicineReserveFromUser->UserParticipant[0]->apMaternal }}"
                                label="NOMBRE COMPLETO" placeholder="" readonly />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-select label="NACIONALIDAD" placeholder="Seleccione..." wire:model.defer="">
                                @foreach ($nationalities as $nationality)
                                    <x-select.option label="{{ $nationality->name }}" value="{{ $nationality->id }}" />
                                @endforeach
                            </x-select>
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user"
                                value="{{ $userDetails->medicineReserveFromUser->UserParticipant[0]->age }}"
                                label="EDAD" placeholder="" readonly />
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input value="{{ $userDetails->dateReserve }}" label="FECHA DE EVALUACIÓN"
                                placeholder="INGRESE..." readonly />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input right-icon="user"
                                value="{{ $userDetails->medicineReserveHeadquarter->name_headquarter }}"
                                label="LUGAR DEL EXAMEN" placeholder="" readonly />
                        </div>
                        <div class="mt-1 relative w-full group">
                            <x-datetime-picker class="py-2.5" label="VIGENCIA DEL EXÁMEN" placeholder="INGRESE..."
                                without-time="false" parse-format="YYYY-MM-DD" display-format="DD-MM-YYYY"
                                wire:model.defer="date_expire" />
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input wire:model.lazy="medical_name" label="MÉDICO EXAMINADOR"
                                placeholder="INGRESE..." />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input
                                value="{{ $userDetails->medicineReserveMedicine->type_exam_id == 1 ? $userDetails->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name : ($userDetails->medicineReserveMedicine->type_exam_id == 2 ? $userDetails->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name : 'NO ES') }}"
                                label="CLASE" placeholder="" readonly />
                        </div>
                        <div class="mt-1 relative z-0 w-full group">
                            <x-input wire:model.lazy="evaluation_result" label="RESULTADO EVALUACIÓN"
                                placeholder="APTO / NO APTO" />
                        </div>
                    </div>
                    <div class="mt-4 grid xl:grid-cols-3 xl:gap-6">
                        <div class="mt-1 relative w-full group">
                            <label for="small"
                                class="block text-sm font-medium text-gray-900 dark:text-white">SUBIR ARCHIVO</label>
                            <input type="file" wire:model="document_license_id" accept=".pdf"
                                class="block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-2.5 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400">
                            <div class="float-left">
                                <div wire:loading wire:target="document_license_id">
                                    Subiendo...
                                    <div style="color: #004ec49a" class="la-ball-fall">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            @error('document_license_id')
                                <span
                                    class="mt-2 bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="py-4 text-right">
                        <x-button wire:click.prevent="save" label="GENERAR QR" info icon="qrcode" />
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
                @endif
            </div>
        </div>
    </div>
</div>
