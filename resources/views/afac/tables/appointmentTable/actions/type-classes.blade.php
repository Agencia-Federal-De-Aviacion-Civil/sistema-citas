<div>
    @foreach ($class as $clas)
        @if ($clas->medicineReserveMedicine->medicineTypeExam->id == 1)
            ok
            {{-- {{ $class->medicineReserveMedicine->medicineInitial[0]->medicineInitialTypeClass->name }} --}}
        @elseif ($clas->medicineReserveMedicine->medicineTypeExam->id == 2)
            {{-- {{ $class->medicineReserveMedicine->medicineRenovation[0]->renovationTypeClass->name }} --}}
            ok
        @elseif ($clas->medicineReserveMedicine->medicineTypeExam->id == 3)
            {{-- {{ $class->medicineReserveMedicine->medicineRevaluation[0]->revaluationMedicineInitial[0]->revaluationInitialTypeClass->name }} --}}
            ok
        @endif
    @endforeach
</div>
