<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\Medicine;
use App\Models\Linguistic\Linguistic;
use App\Models\Medicine\MedicineRevaluation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExam extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function typeExamTypeClass()
    {
        return $this->hasMany(TypeClass::class);
    }
    public function typeExamMedicine()
    {
        return $this->hasMany(Medicine::class);
    }
    public function typeExamLinguistic()
    {
        return $this->hasMany(Linguistic::class);
    }
    public function typeExamRevaluation()
    {
        return $this->hasMany(MedicineRevaluation::class);
    }
}
