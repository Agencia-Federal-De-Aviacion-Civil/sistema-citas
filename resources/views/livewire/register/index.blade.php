<div>
    <div class="relative">
        <section class="min-h-screen bg-cover " style="background-image: url('{{ asset('images/medical-exam.jpg') }}')">
            <div class="flex flex-col min-h-screen bg-black/50">
                <div class="container flex flex-col flex-1 px-6 py-12 mx-auto">
                    <div class="flex-1 lg:flex lg:items-center lg:-mx-6">
                        <div class="text-white lg:w-4/12 lg:mx-6">
                            <h1 class="text-blue-400 dark:text-gray-300 md:text-4xl">Registro</h1>
                            <h1 class="text-2xl font-semibold text-white capitalize dark:text-white lg:text-4xl">
                                Medicina De Aviación
                            </h1>
                            <p class="max-w-xl mt-6">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            </p>
                            <button
                                class="px-8 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-400 focus:ring-opacity-50">
                                Regresar
                            </button>
                        </div>
                        <div class="mt-8 lg:w-9/12 lg:mx-6">
                            <div
                                class="w-full px-8 py-10 mx-auto overflow-hidden bg-white shadow-2xl rounded-xl dark:bg-gray-900 lg:max-w-6xl">
                                <h1 class="text-2xl font-medium text-gray-700 dark:text-gray-200">Registar</h1>

                                <form>
                                    <div class="mt-8 grid md:grid-cols-1 md:gap-6">
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input wire:model="name" type="text" name="floating_first_name"
                                                id="floating_first_name"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_first_name"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre(s)</label>
                                        </div>

                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" name="floating_last_name" id="floating_last_name"
                                                wire:model="apParental"
                                                class="uppercase block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_last_name"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido
                                                Paterno</label>
                                        </div>
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" name="floating_last_name2" id="floating_last_name2"
                                                wire:model="apMaternal"
                                                class="uppercase block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_last_name2"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido
                                                Materno</label>
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6">
                                        <ul
                                            class="items-center w-full text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-license" type="radio"
                                                        value="Femenino" wire:model.defer="genre" name="list-radio"
                                                        class="uppercase w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-license"
                                                        class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Femenino</label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-id" type="radio" value="Masculino"
                                                        wire:model.defer="genre" name="list-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-id"
                                                        class="py-3 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Masculino</label>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="relative z-0 mt-2 w-full group">
                                            <input type="text" name="floating_curp" id="floating_curp" wire:model="curp"
                                                class="uppercase block py-2.5 px-0 w-full text-regular text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_curp"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">CURP</label>
                                        </div>
                                    </div>
                                    <div class="mt-6 grid md:grid-cols-3 md:gap-6">
                                        <div class="relative w-full mb-6 group">
                                            <x-datetime-picker label="Fecha de nacimiento"
                                                placeholder="Seleccione fecha..." parse-format="YYYY-MM-DD"
                                                without-time="false" wire:model="birth"
                                                wire:model.defer="customFormat" />
                                        </div>
                                        <div class="mt-2 relative z-0 mb-6 w-full group">
                                            <label for="state" class="sr-only">Estado</label>
                                            <select id="state" wire:model.lazy="state_id"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                                <option selected>Elige el estado</option>
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-2 relative z-0 mb-6 w-full group">
                                            <label for="municipio" class="sr-only">Municipio</label>
                                            <select id="municipio" wire:model.defer="municipal_id"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                                <option selected>Elige el estado</option>
                                                @foreach ($municipals as $municipal)
                                                <option value="{{ $municipal->id }}">{{$municipal->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="mt-6 relative z-0 mb-6 w-full group">
                                        <input type="password" name="floating_password" id="floating_password"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="floating_password"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                    </div>
                                    <div class="relative z-0 mb-6 w-full group">
                                        <input type="password" name="repeat_password" id="floating_repeat_password"
                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label for="floating_repeat_password"
                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm
                                            password</label>
                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" name="floating_first_name" id="floating_first_name"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_first_name"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                                                name</label>
                                        </div>
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" name="floating_last_name" id="floating_last_name"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_last_name"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                                                name</label>
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone"
                                                id="floating_phone"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_phone"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                                                number (123-456-7890)</label>
                                        </div>
                                        <div class="relative z-0 mb-6 w-full group">
                                            <input type="text" name="floating_company" id="floating_company"
                                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                placeholder=" " required />
                                            <label for="floating_company"
                                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company
                                                (Ex. Google)</label>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>