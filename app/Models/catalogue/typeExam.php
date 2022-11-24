<?php

namespace App\Models\catalogue;

use App\Models\appointment\userAppointment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeExam extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function examClass()
    {
        return $this->hasMany('App\Models\catalogue\typeClass');
    }
    public function typeExamAppointment()
    {
        return $this->hasMany(userAppointment::class);
    }
}
