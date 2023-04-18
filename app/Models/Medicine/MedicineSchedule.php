<?php

namespace App\Models\Medicine;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSchedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineScheduleUser(){
        return $this->belongsTo(User::class,'user_id');
    }
}
