<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRevaluationRenovation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function revaluationRenovationMedicine()
    {
        return $this->belongsTo(MedicineRevaluation::class, 'medicine_revaluation_id');
    }
    public function revaluationRenovationTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
    public function revaluationRenovationClasificationClass()
    {
        return $this->belongsTo(ClasificationClass::class, 'clasification_class_id');
    }
}
