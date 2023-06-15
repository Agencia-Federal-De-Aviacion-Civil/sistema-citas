<div>
    @foreach ($class as $clas)
        @if ($clas->medicineReserveMedicine->type_exam_id == 1)
            {{ $clas->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
        @elseif ($clas->medicineReserveMedicine->type_exam_id == 2)
            {{ $class->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
        @elseif ($clas->medicineReserveMedicine->type_exam_id == 3)
            {{ $class->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }}
        @endif
    @endforeach
</div>
