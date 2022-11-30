<?php

namespace App\Models\appointment;

use App\Models\catalogue\headquarter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_appointment_success extends Model
{
    use HasFactory;
    protected $fillable = ['headquarter_id', 'appointmentDate', 'appointmentTime', 'appointments'];
    // public function successAppointment()
    // {
    //     return $this->belongsTo(userAppointment::class, 'user_appointment_id');
    // }
    public function successHeadquarter()
    {
        return $this->belongsTo(headquarter::class, 'headquarter_id');
    }
}
