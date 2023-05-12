<div class="relative z-0 w-full mb-6 group">
    {!! Form::text('name', null, ['class' => 'block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"', 'placeholder' => 'Ingrese el nombre del rol']) !!}
    {!! Form::label('name', 'Nombre', ['class' => 'peer-focus:font-medium absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6']) !!}
    @error('name')
        <span
            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
            {{ $message }}</span>
    @enderror
    @foreach ($permissions as $permission)
        <div class="mt-3">
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600']) !!}
            <label class="text-base text-gray-900 dark:text-gray-300">{{ $permission->description }}</label>
        </div>
    @endforeach
</div>