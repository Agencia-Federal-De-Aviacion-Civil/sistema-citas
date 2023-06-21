<?php

namespace App\Models\Medicine;

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
}
