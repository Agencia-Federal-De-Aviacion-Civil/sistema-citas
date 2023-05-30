<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('afac.home') }}">
                        <div class="shrink-0 flex items-center">
                            <img class="w-16" src="{{ asset('images/AFAC1.png') }}" alt="AFAC">
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @can('user.see.navigation')
                        <x-jet-nav-link href="{{ route('afac.home') }}" :active="request()->routeIs('afac.home')">
                            {{ __('Inicio') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('super_admin.see.tabs.navigation')
                        <div x-cloak x-data="{ open: false }" class="py-3 z-50">
                            <button x-on:click="open = true"
                                class="flex items-center bg-white focus:bg-gray-50 text-gray-700 focus:text-gray-900 rounded py-2 px-4"
                                type="button">
                                <span class="mr-1 text-base">Medicina de Aviacion</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    style="margin-top:3px">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </button>
                            <ul x-show="open" x-on:click.away="open = false"
                                class="bg-white text-gray-700 rounded shadow-lg absolute py-2 mt-1" style="min-width:15rem">
                                <li>
                                    <a href="{{ route('afac.medicine') }}"
                                        class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                                        Generar cita
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('afac.headquarterMedicine') }}"
                                        class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                                        Sedes
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('validate') }}"
                                        class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                                        Validación de QR
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <x-jet-nav-link href="{{ route('afac.historyRegister') }}" :active="request()->routeIs('afac.historyRegister')">
                            {{ __('Personas registradas') }}
                        </x-jet-nav-link>

                        <x-jet-nav-link href="{{ route('afac.users') }}" :active="request()->routeIs('afac.users')">
                            {{ __('Usuarios') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('see.schedule.tabs')
                        <x-jet-nav-link href="{{ route('afac.appointment') }}" :active="request()->routeIs('afac.appointment')">
                            {{ __('Citas agendadas') }}
                        </x-jet-nav-link>
                    @endcan
                    @can('medicine_admin.see.tabs.navigation')
                        <x-jet-nav-link href="{{ route('afac.headquarterMedicine') }}" :active="request()->routeIs('afac.headquarterMedicine')">
                            {{ __('Administrador de Sedes') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('validate') }}" :active="request()->routeIs('validate')">
                            {{ __('Validación de citas') }}
                        </x-jet-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @can('navigation.see.notifications')
                    @livewire('notifications.appointment')
                @endcan
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Cuenta') }}
                            </div>

                             <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif 

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Cerrar sesión') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link> --}}
        </div>
        @can('generate.appointment')
            <x-jet-nav-link href="{{ route('afac.home') }}" :active="request()->routeIs('afac.home')">
                {{ __('Inicio') }}
            </x-jet-nav-link>
        @endcan
        @can('super_admin.see.tabs.navigation')
            <div x-cloak x-data="{ open: false }" class="py-3 z-50">
                <button x-on:click="open = true"
                    class="flex items-center bg-white focus:bg-gray-50 text-gray-700 focus:text-gray-900 rounded py-2 px-4"
                    type="button">
                    <span class="mr-1 text-base">Medicina de Aviacion</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        style="margin-top:3px">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
                <ul x-show="open" x-on:click.away="open = false"
                    class="bg-white text-gray-700 rounded shadow-lg absolute py-2 mt-1" style="min-width:15rem">
                    <li>
                        <a href="{{ route('afac.medicine') }}"
                            class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Generar cita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('afac.appointment') }}"
                            class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Citas agendadas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('afac.headquarterMedicine') }}"
                            class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Sedes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('validate') }}" class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Validación de QR
                        </a>
                    </li>
                </ul>
            </div>
            <x-jet-nav-link href="{{ route('afac.historyRegister') }}">
                {{ __('Personas Registradas') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('afac.users') }}" :active="request()->routeIs('afac.users')">
                {{ __('Usuarios') }}
            </x-jet-nav-link>
        @endcan
        @can('medicine_admin.see.tabs.navigation')
            <div x-cloak x-data="{ open: false }" class="py-3 z-50">
                <button x-on:click="open = true"
                    class="flex items-center bg-white focus:bg-gray-50 text-gray-700 focus:text-gray-900 rounded py-2 px-4"
                    type="button">
                    <span class="mr-1 text-base">Medicina de Aviacion</span>
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        style="margin-top:3px">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </button>
                <ul x-show="open" x-on:click.away="open = false"
                    class="bg-white text-gray-700 rounded shadow-lg absolute py-2 mt-1" style="min-width:15rem">
                    <li>
                        <a href="{{ route('afac.appointment') }}"
                            class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Citas agendadas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('afac.headquarterMedicine') }}"
                            class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Sedes
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('validate') }}" class="block hover:bg-gray-100 whitespace-no-wrap py-2 px-4">
                            Validación de QR
                        </a>
                    </li>
                </ul>
            </div>
        @endcan
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Cuenta') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Cerrar sessión') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
