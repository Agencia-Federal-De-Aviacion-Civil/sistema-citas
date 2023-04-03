<?php

namespace App\Models\catalogue;

use App\Models\appointment\user_appointment_success;
use App\Models\appointment\userAppointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class headquarter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function headquarterSuccess()
    {
        return $this->hasMany(user_appointment_success::class);
    }
    public function headquarterUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
