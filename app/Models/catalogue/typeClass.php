<?php

namespace App\Models\catalogue;

use App\Models\appointment\userQuestion;
use App\Models\appointment\userRenovation;
use App\Models\appointment\userStudying;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeClass extends Model
{
    use HasFactory;
    protected $fillable = ['type_exam_id','user_question_id','name'];
    public function classExam()
    {
        return $this->belongsTo('App\Models\catalogue\typeExam', 'type_exam_id');
    }
    public function classQuestion()
    {
        return $this->belongsTo(userQuestion::class,'');
    }
    public function classStudying()
    {
        return $this->hasMany(userStudying::class);
    }
    public function classRenovation()
    {
        return $this->hasMany(userRenovation::class);
    }
}
