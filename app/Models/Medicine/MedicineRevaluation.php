<?php

namespace App\Models\Medicine;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRevaluation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function revaluationMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
    public function revaluationDocument()
    {
        return $this->belongsTo(Document::class, 'document_revaloration_id');
    }
    public function revaluationMedicineInitial()
    {
        return $this->hasMany(MedicineRevaluationInitial::class, 'medicine_revaluation_id');
    }
    public function revaluationMedicineRenovation()
    {
        return $this->hasMany(MedicineRevaluationRenovation::class, 'medicine_revaluation_id');
    }
}
