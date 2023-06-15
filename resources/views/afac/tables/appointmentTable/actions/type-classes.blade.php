<div>
    @foreach ($class as $clas)
        @if ($clas->medicineReserveMedicine->type_exam_id == 1)
            {{ $clas->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
        @elseif ($clas->medicineReserveMedicine->type_exam_id == 2)
            {{ $clas->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
        @else
            @if ($clas->medicineReserveMedicine->medicineRevaluation[0]->type_exam_id == 1)
                {{ $clas->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }}
            @else
                {{ $clas->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineRenovation[0]->revaluationRenovationTypeClass->name }}
            @endif
        @endif
    @endforeach
</div>
