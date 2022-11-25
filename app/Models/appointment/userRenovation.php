<?php

namespace App\Models\appointment;

use App\Models\catalogue\clasificationClass;
use App\Models\catalogue\typeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRenovation extends Model
{
    use HasFactory;
    protected $fillable = ['user_appointment_id', 'type_class_id', 'clasification_class_id'];
    public function renovationAppointment(){
        return $this->belongsTo(userAppointment::class,'user_appointment_id');
    }
    public function renovationClass(){
        return $this->belongsTo(typeClass::class,'type_class_id');
    }
    public function renovationClasification(){
        return $this->belongsTo(clasificationClass::class,'clasification_class_id');
    }
}
