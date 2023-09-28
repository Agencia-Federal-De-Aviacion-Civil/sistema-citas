<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineQuestion;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineReservesExtension;
use App\Models\Medicine\MedicineRevaluationInitial;
use App\Models\Medicine\MedicineRevaluationRenovation;
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
    public function typeClassMedicineInitial()
    {
        return $this->hasMany(MedicineInitial::class);
    }
    public function typeClassRenovation()
    {
        return $this->hasMany(MedicineRenovation::class);
    }
    public function typeClassRevaluationInitial()
    {
        return $this->hasMany(MedicineRevaluationInitial::class);
    }
    public function typeClassRevaluationRenovation()
    {
        return $this->hasMany(MedicineRevaluationRenovation::class);
    }
    public function typeClassMedicineExtension()
    {
        return $this->hasMany(MedicineReservesExtension::class, 'type_class_extension_id');
    }
}
