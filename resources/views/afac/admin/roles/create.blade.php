<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
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
