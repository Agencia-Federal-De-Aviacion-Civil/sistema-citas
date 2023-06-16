<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineQuestion extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineQuestionTypeClass()
    {
        return $this->hasMany(TypeClass::class);
    }
    public function questionMedicineInitial()
    {
        return $this->hasMany(MedicineInitial::class);
    }
    public function questionRevaluationInitial()
    {
        return $this->hasMany(MedicineRevaluationInitial::class);
    }
}
