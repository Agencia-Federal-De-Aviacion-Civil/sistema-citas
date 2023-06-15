<div>
    @foreach ($class as $clas)
        @if ($clas->medicineReserveMedicine->type_exam_id == 1)
            {{ $clas->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
            1
        @elseif ($clas->medicineReserveMedicine->type_exam_id == 2)
            {{ $clas->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }}
            2
        @elseif ($clas->medicineReserveMedicine->type_exam_id == 3)
            {{-- {{ $clas->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }} --}}
            3
        @endif
    @endforeach
</div>
