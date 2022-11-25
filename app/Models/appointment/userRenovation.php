<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRenovation extends Model
{
    use HasFactory;
    protected $fillable = ['user_appointment_id', 'type_class_id', 'clasification_class_id'];
    public function renovationAppointment(){
        return $this->belongsTo(userAppointment::class,'user_appointment_id');
    }
}
