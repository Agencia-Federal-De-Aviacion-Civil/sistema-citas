<?php

namespace App\Models\appointment;

use App\Models\catalogue\typeExam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userAppointment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type_exam_id', 'user_payment_document_id', 'paymentConcept', 'paymentDate', 'state'];
    public function appointmentUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function appointmentTypeExam()
    {
        return $this->belongsTo(typeExam::class, 'type_exam_id');
    }
    public function appointmentStudying()
    {
        return $this->hasMany(userStudying::class);
    }
    public function appointmentRenovation()
    {
        return $this->hasMany(userRenovation::class);
    }
    public function appointmentDocument()
    {
        return $this->belongsTo(userPaymentDocument::class, 'user_payment_document_id');
    }
    // public function appointmentSuccess()
    // {
    //     return $this->hasMany(user_appointment_success::class);
    // }
}
