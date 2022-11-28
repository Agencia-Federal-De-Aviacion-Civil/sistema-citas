<?php

namespace App\Models\catalogue;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class headquarter extends Model
{
    use HasFactory;
    public function headquarterSuccess()
    {
        return $this->hasMany(user_appointment_success::class);
    }
}
