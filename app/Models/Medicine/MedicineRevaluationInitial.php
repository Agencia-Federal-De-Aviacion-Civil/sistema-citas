<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRevaluationInitial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function revaluationInicialMedicine()
    {
        return $this->belongsTo(MedicineRevaluation::class, 'medicine_revaluation_id');
    }
    public function revaluationInitialQuestion()
    {
        return $this->belongsTo(MedicineQuestion::class, 'medicine_question_id');
    }
    public function revaluationInitialTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
    public function revaluationInitialClasificationClass()
    {
        return $this->belongsTo(ClasificationClass::class, 'clasification_class_id');
    }
}
