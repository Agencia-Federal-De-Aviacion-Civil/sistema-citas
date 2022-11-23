<div>
    <div class="relative">
        <img src="{{ asset('images/register-background.jpg') }}" class="absolute inset-0 object-cover w-full h-full"
            alt="" />
        <div class="relative bg-gray-800 bg-opacity-50">
            <section class="">
                <div class="max-w-screen-xl px-4 py-10 mx-auto sm:px-6 lg:px-2">
                    <div class="grid grid-cols-1 gap-x-0 gap-y-6 lg:grid-cols-5">
                        <div class="lg:py-40 lg:col-span-2 px-4">
                            <div class="w-full max-w-xl mb-12 xl:mb-0 xl:pr-16 xl:w-7/6">
                                <h2
                                    class="max-w-lg mb-6 font-sans text-2xl font-semibold font-poppins tracking-tight text-white sm:text-3xl sm:leading-none">
                                    BIENVENIDO A<br class="hidden md:block" />
                                    <span class="text-blue-400">MEDICINA DE AVIACIÓN </span>
                                </h2>
                                {{-- <p class="max-w-xl mb-4 text-base text-white md:text-lg">
                                    
                                </p> --}}
                            </div>
                        </div>
                        <div class="p-5 bg-white rounded-lg shadow-lg lg:p-12 lg:col-span-3">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="user" wire:model="name" label="Nombre(s)"
                                        placeholder="Ingresa..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="user" wire:model="apParental" label="Apellido Paterno"
                                        placeholder="Ingresa..." />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="user" wire:model="apMaternal" label="Apellido Materno"
                                        placeholder="Ingresa..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-radio id="md left-label" value="Masculino" wire:model.defer="genre"
                                        left-label="Masculino" />
                                    <x-radio id="md right-label" value="Femenino" wire:model.defer="genre"
                                        label="Femenino" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="finger-print" wire:model="curp" label="Ingresa curp"
                                        placeholder="Ingresa..." />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-3 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-datetime-picker label="Fecha de nacimiento" placeholder="Seleccione fecha..."
                                        parse-format="YYYY-MM-DD" without-time="false" wire:model="birth"
                                        wire:model.defer="customFormat" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-select label="Estado" placeholder="Selecione Estado"
                                        wire:model.lazy="state_id">
                                        @foreach ($states as $state)
                                            <x-select.option label="{{ $state->name }}" value="{{ $state->id }}" />
                                        @endforeach
                                    </x-select>
                                </div>

                                <div class="relative w-full mb-6 group">
                                    <x-select label="Municipio" placeholder="Selecione Municipio"
                                        wire:model.defer="municipal_id">
                                        <x-select.option label="Seleccione..." value="" />
                                        @foreach ($municipals as $municipal)
                                            <x-select.option label="{{$municipal->name}}" value="{{ $municipal->id }}" />
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-3 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                   <x-inputs.maskable icon="hashtag" mask="##" wire:model.lazy="age" label="Edad" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="map" wire:model="street" label="Calle" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="hashtag" wire:model="nInterior" label="N Interior" placeholder="Ingrese" />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="hashtag" wire:model="nExterior" label="N Exterior" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="map" wire:model="suburb" label="Colonia" placeholder="Ingrese" />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="hashtag" wire:model="postalCode" label="Código postal" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="map" wire:model="federalEntity" label="Entidad Federativa" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="map" wire:model="delegation" label="Delegación/Municipio" placeholder="Ingrese" />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-inputs.maskable icon="phone" mask="(##) ##-##-##-##" wire:model.lazy="mobilePhone" label="Telefono movil" placeholder="Ingresa..." />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-inputs.maskable icon="phone" mask="(##) ##-##-##-##" wire:model.lazy="officePhone" label="Telefono oficina" placeholder="Ingresa" />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="hashtag" wire:model="extension" label="Ext." placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-input icon="mail-open" wire:model="email" label="Correo electrónico"
                                        placeholder="Ingrese" />
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative w-full mb-6 group">
                                    <x-inputs.password wire:model="passwordConfirmation" label="Contraseña" placeholder="Ingrese" />
                                </div>
                                <div class="relative w-full mb-6 group">
                                    <x-inputs.password wire:model="password" right-icon="pencil" label="Confirmar contraseña"
                                        placeholder="Ingrese" />
                                </div>
                            </div>
                            <div class="text-right">
                                <x-button wire:click="register" spinner="register" loading-delay="short" primary
                                    label="Registrar" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
