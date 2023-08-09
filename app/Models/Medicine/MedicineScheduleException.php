<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\TypeExam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineScheduleException extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineSchedules()
    {
        return $this->belongsTo(MedicineSchedule::class, 'medicine_schedule_id');
    }
    public function medicineSchedulesTypeExam()
    {
        return $this->belongsTo(TypeExam::class, 'type_exam_id');
    }
    public function medicineScheduleMaxException()
    {
        return $this->belongsTo(MedicineScheduleExceptionMaxException::class, 'schedule_exception_max_id');
    }
}
