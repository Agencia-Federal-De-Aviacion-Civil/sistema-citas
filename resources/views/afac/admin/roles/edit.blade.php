<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                {!! Form::model($role, ['route' => ['afac.roles.update', $role], 'method' => 'put']) !!}
                @include('afac.admin.roles.partials.form')
                {!! Form::submit('EDITAR', [
                    'class' =>
                        'px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</x-app-layout>
