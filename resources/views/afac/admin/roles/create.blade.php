<x-app-layout>
    <div class="py-2">
        <div class="container px-6 p-y-1 mx-auto">
            {!! Form::open(['route' => 'afac.roles.store']) !!}
            @include('afac.admin.roles.partials.form')
            {!! Form::submit('Crear Rol', [
                'class' =>
                    'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800',
            ]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</x-app-layout>
