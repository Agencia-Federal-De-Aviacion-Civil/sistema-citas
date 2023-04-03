<?php

namespace App\Models\appointment;

use App\Models\catalogue\headquarter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_appointment_success extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public function successAppointment()
    // {
    //     return $this->belongsTo(userAppointment::class, 'user_appointment_id');
    // }
    public function successUser()
    {
        return $this->belongsTo(User::class, 'to_user_headquarters');
    }
    public function successAppointment()
    {
        return $this->hasMany(userAppointment::class);
    }
}
