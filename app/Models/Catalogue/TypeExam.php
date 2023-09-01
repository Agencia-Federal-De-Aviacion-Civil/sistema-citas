<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineRevaluation;
use App\Models\Medicine\MedicineScheduleException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class TypeExam extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $guarded = ['id'];
    public function typeExamTypeClass()
    {
        return $this->hasMany(TypeClass::class);
    }
    public function typeExamMedicine()
    {
        return $this->hasMany(Medicine::class);
    }
    public function typeExamRevaluation()
    {
        return $this->hasMany(MedicineRevaluation::class);
    }
    public function typeExamMedicineSchedules()
    {
        return $this->hasMany(MedicineScheduleException::class);
    }
}
