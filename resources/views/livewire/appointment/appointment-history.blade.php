<div>
    <div class="py-12">
        <div class="container mx-auto px-4 py-4 bg-white shadow-xl sm:rounded-lg">
            <div class="mt-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="ml-4 py-6 mr-4">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NOMBRE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    TIPO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    CLASE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tipo de Licencia
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    SEDE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    FECHA Y HORA
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{-- {{ $n++ }} --}}
                                    </th>

                                    <td class="px-6 py-4">
                                        {{ $appointment->appointmentUser->name . ' ' . $appointment->appointmentUser->apParental . ' ' . $appointment->appointmentUser->apMaternal }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $appointment->appointmentTypeExam->name }}
                                    </td>
                                    @if ($appointment->appointmentTypeExam->id == 1)
                                        <td class="px-6 py-4">
                                            {{ $appointment->appointmentStudying[0]->studyingClass->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $appointment->appointmentStudying[0]->studyingClasification->name }}
                                        </td>
                                    @elseif($appointment->appointmentTypeExam->id == 2)
                                        <td class="px-6 py-4">
                                            {{ $appointment->appointmentRenovation[0]->renovationClass->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $appointment->appointmentRenovation[0]->renovationClasification->name }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        {{$appointment->appointmentSuccess->successHeadquarter->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $appointment->appointmentSuccess->appointmentDate . ' ' . $appointment->appointmentSuccess->appointmentTime }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{-- {{ $RequestList->requestExamTypeExam->name }} --}}
                                    </td>
                                </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="mt-6 ml-6 mr-6 mb-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
