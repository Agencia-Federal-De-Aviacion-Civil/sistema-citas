<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\MedicineQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function typeClassTypeExam()
    {
        return $this->belongsTo(TypeExam::class, 'type_exam_id');
    }
    public function typeClassMedicineQuestion()
    {
        return $this->belongsTo(MedicineQuestion::class, 'medicine_question_id');
    }
    public function typeClassClasificationClass()
    {
        return $this->hasMany(ClasificationClass::class);
    }
}
