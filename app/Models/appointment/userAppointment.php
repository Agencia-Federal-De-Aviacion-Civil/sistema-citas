<?php

namespace App\Models\appointment;

use App\Models\catalogue\typeExam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userAppointment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type_exam_id', 'state'];
    public function appointmentUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function appointmentTypeExam()
    {
        return $this->belongsTo(typeExam::class, 'type_exam_id');
    }
}
