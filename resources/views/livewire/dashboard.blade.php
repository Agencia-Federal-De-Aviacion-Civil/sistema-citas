<div>
    <x-banner-component :title="'Bienvenido al Sistema de citas AFAC'" />
    <div class="py-2">
        <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
            <div class="container px-6 p-y-1 mx-auto">
                <section class="text-gray-600 body-font">
                    <div class="container px-6 py-1 mx-auto">
                        <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-12 md:grid-cols-2 xl:grid-cols-3">
                            <a @click="showModal = true">
                                <div
                                    class="group bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden transition duration-100 transform hover:scale-105 hover:cursor-pointer">
                                    <div class="overflow-hidden bg-cover cursor-pointer lg:h-48 md:h-36 w-full object-cover object-center group"
                                        style="background-image:url('{{ asset('images/medicina-aviacion.jpg') }}')">
                                        <div
                                            class="flex flex-col justify-center w-full h-full px-8 py-4 transition-opacity duration-700 opacity-0 backdrop-blur-sm bg-gray-800 group-hover:opacity-70">
                                            <h2 class="mt-4 text-2xl font-semibold text-white capitalize">NUEVA CITA
                                            </h2>
                                            <p class="mt-2 text-lg tracking-wider text-blue-300 uppercase ">MEDICINA
                                                DE
                                                AVIACIÓN</p>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                            MEDICINA DE AVIACIÓN
                                        </h1>
                                        <div class="flex items-center flex-wrap ">
                                            <p
                                                class="group-hover:animate-pulse text-sky-700 inline-flex items-center md:mb-2 lg:mb-0">
                                                GENERAR CITA
                                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l7 7-7 7"></path>
                                                </svg>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div x-cloak x-show="showModal" x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-start="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave="transition duration-150 ease-in"
                        x-transition:leave-start="translate-y-0 opacity-100 sm:scale-100"
                        x-transition:leave-end="translate-y-4 opacity-0 sm:translate-y-0 sm:scale-95"
                        class="fixed inset-0 z-20 overflow-y-auto overflow-auto bg-black bg-opacity-50"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">

                        <div tabindex="-1"
                            class="flex justify-center z-40 h-full w-full fixed top-0 left-0 items-center md:inset-0 h-[calc(100%-1rem)]">
                            <div class="relative w-full max-w-3xl max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-6 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            ¿EN DONDE REALIZARAS TU CITA?</h3>
                                        {{-- <x-select label="SELECCIONA LA SEDE" placeholder="SELECCIONA..."
                                            wire:model.defer="selectedHeadquarter">
                                            @foreach ($headquartersAfac as $headquarterAfac)
                                                <x-select.option label="{{ $headquarterAfac->name_headquarter }}"
                                                    value="{{ $headquarterAfac->id . '-' . $headquarterAfac->is_external }}" />
                                            @endforeach
                                        </x-select> --}}
                                        {{-- <div class="grid grid-cols-1 gap-4 mt-4 xl:mt-4 md:grid-cols-2 xl:grid-cols-2">
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(false)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-24" src="{{ asset('images/AFAC1.png') }}"
                                                        alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Agencia Federal de Aviación Civil</p>
                                                </div>
                                            </button>
                                            <button class="hover:animate-pulse" wire:click.prevent='goAfac(true)'>
                                                <div
                                                    class="flex flex-col items-center p-3 transition-colors duration-300 transform border cursor-pointer rounded-xl hover:border-transparent group hover:bg-gray-100 dark:border-gray-700 dark:hover:border-transparent">
                                                    <img class="object-cover w-20"
                                                        src="{{ asset('images/saludlogo.png') }}" alt="">
                                                    <p
                                                        class="mt-2 text-gray-500 capitalize dark:text-gray-300 group-hover:text-gray-600">
                                                        Instituciones para terceros</p>
                                                </div>
                                            </button>
                                        </div> --}}
                                        <button
                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:bg-gray-100 w-full p-4 shadow rounded bg-white text-sm font-medium leading-none text-gray-800 flex items-center justify-between cursor-pointer"
                                            onclick="dropdownHandler()">
                                            Selecciona la sede
                                            <div>
                                                <div class="hidden" id="close">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.00016 0.666664L9.66683 5.33333L0.333496 5.33333L5.00016 0.666664Z"
                                                            fill="#1F2937" />
                                                    </svg>
                                                </div>
                                                <div id="open">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.00016 5.33333L0.333496 0.666664H9.66683L5.00016 5.33333Z"
                                                            fill="#1F2937" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </button>
                                        <div class="w-full mt-2 p-4 bg-white shadow rounded" id="dropdown">
                                            <div class="bg-white max-w-full mx-auto border border-gray-200">
                                                <ul class="shadow-box">

                                                    <li class="relative border-b border-gray-200"
                                                        x-data="{ selected: null }">

                                                        <button type="button" class="w-full px-8 py-6 text-left"
                                                            @click="selected !== 1 ? selected = 1 : selected = null">
                                                            <div class="flex items-center justify-between">
                                                                <span>
                                                                    Ciudad de México </span>
                                                                <span class="text-white bg-blue-500 rounded-full">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </button>

                                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700"
                                                            style="" x-ref="container1"
                                                            x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1
                                                                .scrollHeight + 'px' : ''">
                                                            <div class="p-6">
                                                                <p>reCAPTCHA v2 is not going away! We will continue to
                                                                    fully support and improve security and usability for
                                                                    v2.</p>
                                                                <p>reCAPTCHA v3 is intended for power users, site owners
                                                                    that want more data about their traffic, and for use
                                                                    cases in which it is not appropriate to show a
                                                                    challenge to the user.</p>
                                                                <p>For example, a registration page might still use
                                                                    reCAPTCHA v2 for a higher-friction challenge,
                                                                    whereas more common actions like sign-in, searches,
                                                                    comments, or voting might use reCAPTCHA v3. To see
                                                                    more details, see the reCAPTCHA v3 developer guide.
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </li>


                                                    <li class="relative border-b border-gray-200"
                                                        x-data="{ selected: null }">

                                                        <button type="button" class="w-full px-8 py-6 text-left"
                                                            @click="selected !== 2 ? selected = 2 : selected = null">
                                                            <div class="flex items-center justify-between">
                                                                <span>
                                                                    I'd like to run automated tests with reCAPTCHA. What
                                                                    should I do? </span>
                                                                <span class="ico-plus"></span>
                                                            </div>
                                                        </button>

                                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700"
                                                            style="" x-ref="container2"
                                                            x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2
                                                                .scrollHeight + 'px' : ''">
                                                            <div class="p-6">
                                                                <p>For reCAPTCHA v3, create a separate key for testing
                                                                    environments. Scores may not be accurate as
                                                                    reCAPTCHA v3 relies on seeing real traffic.</p>
                                                                <p>For reCAPTCHA v2, use the following test keys. You
                                                                    will always get No CAPTCHA and all verification
                                                                    requests will pass.</p>
                                                            </div>
                                                        </div>

                                                    </li>


                                                    <li class="relative border-b border-gray-200"
                                                        x-data="{ selected: null }">

                                                        <button type="button" class="w-full px-8 py-6 text-left"
                                                            @click="selected !== 3 ? selected = 3 : selected = null">
                                                            <div class="flex items-center justify-between">
                                                                <span>
                                                                    Can I run reCAPTCHA v2 and v3 on the same page?
                                                                </span>
                                                                <span class="ico-plus"></span>
                                                            </div>
                                                        </button>

                                                        <div class="relative overflow-hidden transition-all max-h-0 duration-700"
                                                            style="" x-ref="container3"
                                                            x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3
                                                                .scrollHeight + 'px' : ''">
                                                            <div class="p-6">
                                                                <p>To do this, load the v3 site key as documented, and
                                                                    then explicitly render v2 using grecaptcha.render.
                                                                </p>
                                                                <p>You are allowed to hide the badge as long as you
                                                                    include the reCAPTCHA branding visibly in the user
                                                                    flow. Please include the following text:</p>
                                                                <p>Yes, please use "www.recaptcha.net" in your code in
                                                                    circumstances when "www.google.com" is not
                                                                    accessible.</p>
                                                                <ul>
                                                                    <li>First, replace &lt;script
                                                                        src="httFps://www.google.com/recaptcha/api.js"
                                                                        async defer&gt;&lt;/script&gt; with &lt;script
                                                                        src="https://www.recaptcha.net/recaptcha/api.js"
                                                                        async defer&gt;&lt;/script&gt;</li>
                                                                    <li>After that, apply the same to everywhere else
                                                                        that uses "www.google.com/recaptcha/" on your
                                                                        site.</li>
                                                                </ul>
                                                                <p>After that, apply the same to everywhere else that
                                                                    uses "www.google.com/recaptcha/" on your site.</p>
                                                            </div>
                                                        </div>

                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <svg role="button" aria-label="dropdown" tabindex="0"
                                                        onclick="toggleSubDir(1)" onkeypress="toggleSubDir(1)"
                                                        class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md"
                                                        width="12" height="12" viewBox="0 0 12 12"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.5 3L7.5 6L4.5 9" stroke="#4B5563"
                                                            stroke-width="1.25" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>

                                                    <div class="pl-4 flex items-center">
                                                        <h2 id="fb1" tabindex="0"
                                                            class="text-lg font-medium text-gray-800 dark:text-white">
                                                            Ciudad de México</h2>
                                                        {{-- <p id="fb1" tabindex="0"
                                                            class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                            Ciudad de México</p> --}}
                                                    </div>
                                                </div>
                                                <span
                                                    class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                                    users</span>
                                            </div>

                                            <div id="sublist1" class="pl-2 pt-5 hidden">
                                                <section class="container px-4 mx-auto">
                                                    <div class="flex items-center gap-x-3">
                                                        <h2 class="text-lg font-medium text-gray-800 dark:text-white">
                                                            Team members</h2>

                                                        <span
                                                            class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">100
                                                            users</span>
                                                    </div>

                                                    <div class="flex flex-col mt-6">
                                                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                                            <div
                                                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                                                <div
                                                                    class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                                                                    <table
                                                                        class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                                            <tr>
                                                                                <th scope="col"
                                                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                    <div
                                                                                        class="flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">
                                                                                        <span>Name</span>
                                                                                    </div>
                                                                                </th>

                                                                                <th scope="col"
                                                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                    <button
                                                                                        class="flex items-center gap-x-2">
                                                                                        <span>Status</span>

                                                                                        <svg class="h-3"
                                                                                            viewBox="0 0 10 11"
                                                                                            fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                                                                                                fill="currentColor"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="0.1" />
                                                                                            <path
                                                                                                d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                                                                                                fill="currentColor"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="0.1" />
                                                                                            <path
                                                                                                d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                                                                                                fill="currentColor"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="0.3" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </th>

                                                                                <th scope="col"
                                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                    <button
                                                                                        class="flex items-center gap-x-2">
                                                                                        <span>Role</span>

                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            fill="none"
                                                                                            viewBox="0 0 24 24"
                                                                                            stroke-width="2"
                                                                                            stroke="currentColor"
                                                                                            class="w-4 h-4">
                                                                                            <path
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </th>

                                                                                <th scope="col"
                                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                    Email address</th>

                                                                                <th scope="col"
                                                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                                                    Teams</th>

                                                                                <th scope="col"
                                                                                    class="relative py-3.5 px-4">
                                                                                    <span class="sr-only">Edit</span>
                                                                                </th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody
                                                                            class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                                                            <tr>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                        <div
                                                                                            class="flex items-center gap-x-2">
                                                                                            <img class="object-cover w-10 h-10 rounded-full"
                                                                                                src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80"
                                                                                                alt="">
                                                                                            <div>
                                                                                                <h2
                                                                                                    class="font-medium text-gray-800 dark:text-white ">
                                                                                                    Arthur Melo</h2>
                                                                                                <p
                                                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                                                    @authurmelo</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                                                        <span
                                                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                                        <h2
                                                                                            class="text-sm font-normal text-emerald-500">
                                                                                            Active</h2>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    Design Director</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    authurmelo@example.com</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-2">
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                            Design</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                                                                            Product</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                                                                            Marketing</p>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-6">
                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                        </button>

                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                        <div
                                                                                            class="flex items-center gap-x-2">
                                                                                            <img class="object-cover w-10 h-10 rounded-full"
                                                                                                src="https://images.unsplash.com/photo-1531590878845-12627191e687?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80"
                                                                                                alt="">
                                                                                            <div>
                                                                                                <h2
                                                                                                    class="font-medium text-gray-800 dark:text-white ">
                                                                                                    Amelia. Anderson
                                                                                                </h2>
                                                                                                <p
                                                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                                                    @ameliaanderson</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                                                        <span
                                                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                                        <h2
                                                                                            class="text-sm font-normal text-emerald-500">
                                                                                            Active</h2>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    Lead Developer</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    ameliaanderson@example.com</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-2">
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                            Design</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                                                                            Product</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                                                                            Marketing</p>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-6">
                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                        </button>

                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                        <div
                                                                                            class="flex items-center gap-x-2">
                                                                                            <img class="object-cover w-10 h-10 rounded-full"
                                                                                                src="https://images.unsplash.com/photo-1608174386344-80898cec6beb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                                                                alt="">
                                                                                            <div>
                                                                                                <h2
                                                                                                    class="font-medium text-gray-800 dark:text-white ">
                                                                                                    junior REIS</h2>
                                                                                                <p
                                                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                                                    @junior</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                                                        <span
                                                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                                        <h2
                                                                                            class="text-sm font-normal text-emerald-500">
                                                                                            Active</h2>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    Products Managers</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    junior@example.com</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-2">
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                            Design</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                                                                            Product</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                                                                            Marketing</p>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-6">
                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                        </button>

                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                        <div
                                                                                            class="flex items-center gap-x-2">
                                                                                            <img class="object-cover w-10 h-10 rounded-full"
                                                                                                src="https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                                                                                alt="">
                                                                                            <div>
                                                                                                <h2
                                                                                                    class="font-medium text-gray-800 dark:text-white ">
                                                                                                    Olivia Wathan</h2>
                                                                                                <p
                                                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                                                    @oliviawathan</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                                                        <span
                                                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                                        <h2
                                                                                            class="text-sm font-normal text-emerald-500">
                                                                                            Active</h2>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    Lead Designer</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    oliviawathan@example.com</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-2">
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                            Design</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                                                                            Product</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                                                                            Marketing</p>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-6">
                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                        </button>

                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center gap-x-3">
                                                                                        <input type="checkbox"
                                                                                            class="text-blue-500 border-gray-300 rounded dark:bg-gray-900 dark:ring-offset-gray-900 dark:border-gray-700">

                                                                                        <div
                                                                                            class="flex items-center gap-x-2">
                                                                                            <img class="object-cover w-10 h-10 rounded-full"
                                                                                                src="https://images.unsplash.com/photo-1499470932971-a90681ce8530?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                                                                                                alt="">
                                                                                            <div>
                                                                                                <h2
                                                                                                    class="font-medium text-gray-800 dark:text-white ">
                                                                                                    Mia</h2>
                                                                                                <p
                                                                                                    class="text-sm font-normal text-gray-600 dark:text-gray-400">
                                                                                                    @mia</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-12 py-4 text-sm font-medium text-gray-700 whitespace-nowrap">
                                                                                    <div
                                                                                        class="inline-flex items-center px-3 py-1 rounded-full gap-x-2 bg-emerald-100/60 dark:bg-gray-800">
                                                                                        <span
                                                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                                                        <h2
                                                                                            class="text-sm font-normal text-emerald-500">
                                                                                            Active</h2>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    Graphic Designer</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                                                    mia@example.com</td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-2">
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-indigo-500 rounded-full dark:bg-gray-800 bg-indigo-100/60">
                                                                                            Design</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-blue-500 rounded-full dark:bg-gray-800 bg-blue-100/60">
                                                                                            Product</p>
                                                                                        <p
                                                                                            class="px-3 py-1 text-xs text-pink-500 rounded-full dark:bg-gray-800 bg-pink-100/60">
                                                                                            Marketing</p>
                                                                                    </div>
                                                                                </td>
                                                                                <td
                                                                                    class="px-4 py-4 text-sm whitespace-nowrap">
                                                                                    <div
                                                                                        class="flex items-center gap-x-6">
                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                                                            </svg>
                                                                                        </button>

                                                                                        <button
                                                                                            class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                fill="none"
                                                                                                viewBox="0 0 24 24"
                                                                                                stroke-width="1.5"
                                                                                                stroke="currentColor"
                                                                                                class="w-5 h-5">
                                                                                                <path
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round"
                                                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                                                            </svg>
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex items-center justify-between mt-6">
                                                        <a href="#"
                                                            class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-5 h-5 rtl:-scale-x-100">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                                            </svg>

                                                            <span>
                                                                previous
                                                            </span>
                                                        </a>

                                                        <div class="items-center hidden lg:flex gap-x-3">
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-blue-500 rounded-md dark:bg-gray-800 bg-blue-100/60">1</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">2</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">3</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">...</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">12</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">13</a>
                                                            <a href="#"
                                                                class="px-2 py-1 text-sm text-gray-500 rounded-md dark:hover:bg-gray-800 dark:text-gray-300 hover:bg-gray-100">14</a>
                                                        </div>

                                                        <a href="#"
                                                            class="flex items-center px-5 py-2 text-sm text-gray-700 capitalize transition-colors duration-200 bg-white border rounded-md gap-x-2 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                                            <span>
                                                                Next
                                                            </span>

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-5 h-5 rtl:-scale-x-100">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </section>
                                            </div>
                                            <div>
                                                <div class="flex items-center justify-between mt-4">
                                                    <div class="flex items-center">
                                                        <svg role="button" aria-label="dropdown" tabindex="0"
                                                            onclick="toggleSubDir(2)" onkeypress="toggleSubDir(2)"
                                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md"
                                                            width="12" height="12" viewBox="0 0 12 12"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.5 3L7.5 6L4.5 9" stroke="#4B5563"
                                                                stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>

                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="twitter2" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="twitter2" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                CANCUN</p>
                                                        </div>
                                                    </div>
                                                    <p tabindex="0"
                                                        class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                        3,521</p>
                                                </div>
                                                <div id="sublist2" class="pl-8 pt-5 hidden">
                                                    <div class="flex items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="usa2" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="usa2" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                USA</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                    <div class="flex pt-4 items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="ger2" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="ger2" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                Germany</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                    <div class="flex pt-4 items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="italy2" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="italy2" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                Italy</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex items-center justify-between mt-4">
                                                    <div class="flex items-center">
                                                        <svg role="button" aria-label="dropdown" tabindex="0"
                                                            onclick="toggleSubDir(3)" onkeypress="toggleSubDir(3)"
                                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md"
                                                            width="12" height="12" viewBox="0 0 12 12"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.5 3L7.5 6L4.5 9" stroke="#4B5563"
                                                                stroke-width="1.25" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>

                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="insta3" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="insta3" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                MONTERRET</p>
                                                        </div>
                                                    </div>
                                                    <p tabindex="0"
                                                        class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                        5,142</p>
                                                </div>
                                                <div id="sublist3" class="pl-8 pt-5">
                                                    <div class="flex items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="usa3" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="usa3" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                USA</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                    <div class="flex pt-4 items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="germany3" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="germany3" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                Germany</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                    <div class="flex pt-4 items-center justify-between">
                                                        <div class="pl-4 flex items-center">
                                                            <div
                                                                class="bg-gray-100 dark:bg-gray-800 border rounded-sm border-gray-200 dark:border-gray-700 w-3 h-3 flex flex-shrink-0 justify-center items-center relative">
                                                                <input aria-labelledby="italy3" type="checkbox"
                                                                    class="focus:opacity-100 checkbox opacity-0 absolute cursor-pointer w-full h-full" />
                                                                <div
                                                                    class="check-icon hidden bg-indigo-700 text-white rounded-sm">
                                                                    <svg class="icon icon-tabler icon-tabler-check"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="12" height="12"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z" />
                                                                        <path d="M5 12l5 5l10 -10" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <p id="italy3" tabindex="0"
                                                                class="focus:outline-none text-sm leading-normal ml-2 text-gray-800">
                                                                Italy</p>
                                                        </div>
                                                        <p tabindex="0"
                                                            class="focus:outline-none w-8 text-xs leading-3 text-right text-indigo-700">
                                                            2,381</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-6 mb-6">
                                            <x-button wire:click.prevent="selected" right-icon="arrow-circle-right"
                                                primary label="CONTINUAR" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<style>
    .checkbox:checked+.check-icon {
        display: flex;
    }
</style>
<script>
    let dropdown = document.getElementById("dropdown");
    let open1 = document.getElementById("open");
    let close1 = document.getElementById("close");

    let flag = true;
    const dropdownHandler = () => {
        if (!flag) {
            dropdown.classList.add("hidden");
            open1.classList.add("hidden");
            close1.classList.remove("hidden");
            flag = true;
        } else {
            dropdown.classList.remove("hidden");
            close1.classList.add("hidden");
            open1.classList.remove("hidden");
            flag = false;
        }
    };
    const toggleSubDir = (check) => {
        let subList1 = document.getElementById("sublist1");
        let subList2 = document.getElementById("sublist2");
        let subList3 = document.getElementById("sublist3");
        switch (check) {
            case 1:
                subList3.classList.add("hidden");
                subList2.classList.add("hidden");
                subList1.classList.remove("hidden");
                break;
            case 2:
                subList3.classList.add("hidden");
                subList2.classList.remove("hidden");
                subList1.classList.add("hidden");
                break;
            case 3:
                subList3.classList.remove("hidden");
                subList2.classList.add("hidden");
                subList1.classList.add("hidden");
                break;
        }
    };
</script>
