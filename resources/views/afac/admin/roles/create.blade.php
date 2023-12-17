<x-app-layout>
    <div class="w-full relative py-6 lg:py-4">
        <img class="z-0 w-full h-full absolute inset-0 object-cover" src="{{ asset('images/banner_testing.jpg') }}"
            alt="bg" />
        <div class="z-10 relative container px-6 flex flex-col md:flex-row items-start md:items-center justify-between">
            <div>
                <h4 tabindex="0" class="focus:outline-none text-2xl font-bold leading-tight text-white w-full">Agregar Rol
                </h4>
                <ul class="flex flex-col md:flex-row items-start md:items-center text-gray-300 text-sm mt-3">
                    <li class="flex items-center mt-4 md:mt-0">
                        <div class="mr-1">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/background_with_sub_text-svg3.svg"
                                alt="date">
                        </div>
                        <div class="flex items-center py-1 overflow-x-auto whitespace-nowrap">
                            <a href="{{ route('afac.roles.index') }}" class="text-gray-400 hover:underline">
                               Roles y Permisos
                            </a>

                            <span class="mx-5 text-gray-400 dark:text-gray-300">
                                /
                            </span>

                            <a href="#" class="text-white hover:underline">
                                Agregar Roles
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-8 py-8 uppercase">
                {!! Form::open(['route' => 'afac.roles.store']) !!}
                @include('afac.admin.roles.partials.form')
                {!! Form::submit('GUARDAR', [
                    'class' =>
                        'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
