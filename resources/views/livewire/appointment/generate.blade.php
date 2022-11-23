<div>
    <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿QUE TIPO DE EXÁMEN VAS
        A REALIZAR?</label>
    <select id="small" wire:model=""
        class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option selected value="">Seleccione...</option>
        @foreach ($typeExamens as $typeExam)
            <option value="{{ $typeExam->id }}">{{ $typeExam->name }}</option>
        @endforeach
    </select>
</div>
