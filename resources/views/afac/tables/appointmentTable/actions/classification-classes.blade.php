<div>
    @foreach ($licencias as $licencia)
        @if ($licencia->medicineReserveMedicine->medicineTypeExam->id == 1)
            {{ $licencia->medicineReserveMedicine->medicineInitial[0]->medicineInitialClasificationClass->name }}
        @elseif ($licencia->medicineReserveMedicine->medicineTypeExam->id == 2)
            {{ $licencia->medicineReserveMedicine->medicineRenovation[0]->renovationClasificationClass->name }}
        @elseif ($licencia->medicineReserveMedicine->medicineTypeExam->id == 3)
            @if ($licencia->medicineReserveMedicine->medicineRevaluation[0]->RevaluationTypeExam->id == 1)
                {{ $licencia->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialClasificationClass->name }}
            @else
                {{ $licencia->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationClasificationClass->name }}
            @endif
        @endif
    @endforeach
</div>
