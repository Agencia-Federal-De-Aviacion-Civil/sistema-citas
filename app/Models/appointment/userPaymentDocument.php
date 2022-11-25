<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userPaymentDocument extends Model
{
    use HasFactory;
    protected $fillable = ['document'];
    public function documentAppointment()
    {
        return $this->hasMany(userAppointment::class);
    }
}
