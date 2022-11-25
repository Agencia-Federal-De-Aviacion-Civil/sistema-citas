<?php

namespace App\Models\appointment;

use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\typeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userStudying extends Model
{
    use HasFactory;
    protected $fillable = ['user_appointment_id', 'user_question_id', 'type_class_id', 'clasification_class_id'];
    public function studyingAppointment()
    {
        return $this->belongsTo(userAppointment::class, 'user_appointment_id');
    }
    public function studyingQuestion()
    {
        return $this->belongsTo(userQuestion::class, 'user_question_id');
    }
    public function studyingClass()
    {
        return $this->belongsTo(typeClass::class, 'type_class_id');
    }
    public function studyingClasification()
    {
        return $this->belongsTo(clasificationClass::class, 'clasification_class_id');
    }
}
