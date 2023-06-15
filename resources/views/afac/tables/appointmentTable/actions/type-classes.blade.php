<div>
    @foreach ($class as $clas)
        @if ($clas->medicineReserveMedicine->type_exam_id == 1)
            {{ $class->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }}
        @elseif ($clas->medicineReserveMedicine->medicineTypeExam->id == 2)
            {{-- {{ $class->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }} --}}
        @elseif ($clas->medicineReserveMedicine->medicineTypeExam->id == 3)
            {{-- {{ $class->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }}
            3 --}}
        @endif
    @endforeach
</div>
