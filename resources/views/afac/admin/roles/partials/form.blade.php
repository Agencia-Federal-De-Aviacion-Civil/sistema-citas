<div class="relative z-0 w-full mb-6 group">
    {!! Form::text('name', null, ['class' => 'block py-2.5 px-0 w-full text-xl font-semiblod text-gray-900 bg-transparent border-0 border-b-2 border-blue-500 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"', 'placeholder' => 'Ingrese el nombre del rol']) !!}
    {!! Form::label('name', 'Nombre', ['class' => 'peer-focus:font-medium absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6']) !!}
    @error('name')
        <span
            class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
            {{ $message }}</span>
    @enderror
    @foreach ($permissions as $permission)
        {{-- <div class="mt-3">
            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600']) !!}
            <label class="text-base text-gray-900 dark:text-gray-300">{{ $permission->description }}</label>
        </div> --}}
        <div class="space-y-2 mt-2">
            <!-- Card -->
            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
              <label for="hs-account-activity" class="flex p-2 md:p-2">
                <span class="flex mr-2">
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'relative shrink-0 w-[3.25rem] h-7 bg-gray-100 checked:bg-none checked:bg-blue-600 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 border border-transparent ring-1 ring-transparent focus:border-blue-600 focus:ring-blue-600 ring-offset-white focus:outline-none appearance-none dark:bg-gray-700 dark:checked:bg-blue-600 dark:focus:ring-offset-gray-800 before:inline-block before:w-6 before:h-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:shadow before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200']) !!}
                  <span class="ml-2">
                    
                    <span class="block text-md text-gray-800">{{ $permission->description }}</span>
                  </span>
                </span>
              </label>
            </div>
        </div>
    @endforeach
</div>