<div>
    @foreach ($classes as $class)
        @if ($class->medicineReserveMedicine->medicineTypeExam->id == 1)
            ok
            {{-- {{ $class->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }} --}}
        @elseif ($class->medicineReserveMedicine->medicineTypeExam->id == 2)
            {{-- {{ $class->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }} --}}
            ok
        @elseif ($class->medicineReserveMedicine->medicineTypeExam->id == 3)
            {{-- {{ $class->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }} --}}
            ok
        @endif
    @endforeach
</div>
