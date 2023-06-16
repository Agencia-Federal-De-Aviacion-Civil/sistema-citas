<?php

namespace App\Models\Linguistic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catalogue\TypeExam;
use App\Models\User;

class Linguistic extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function linguisticUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function linguisticReserve()
    {
        return $this->hasMany(LinguisticReserve::class);
    }
    public function linguisticTypeExam()
    {
        return $this->belongsTo(TypeExam::class, 'type_exam_id');
    }
}
