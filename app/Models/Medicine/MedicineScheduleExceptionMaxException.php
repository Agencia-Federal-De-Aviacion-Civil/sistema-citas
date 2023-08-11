<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineScheduleExceptionMaxException extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function maxExceptionMedicineSchedule()
    {
        return $this->hasMany(MedicineScheduleException::class, 'schedule_exception_max_id');
    }
}
