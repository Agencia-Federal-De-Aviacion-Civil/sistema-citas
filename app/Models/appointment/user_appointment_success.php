<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_appointment_success extends Model
{
    use HasFactory;
    protected $fillable = ['headquarter_id', 'appointmentDate', 'appointments'];
}
