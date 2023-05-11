<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\MedicineInitial;
use App\Models\Medicine\MedicineRenovation;
use App\Models\Medicine\MedicineRevaluationInitial;
use App\Models\Medicine\MedicineRevaluationRenovation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasificationClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function clasificationClassTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
    public function clasificationClassMedicineInitial()
    {
        return $this->hasMany(MedicineInitial::class);
    }
    public function clasificationClassRenovation()
    {
        return $this->hasMany(MedicineRenovation::class);
    }
    public function clasificationClassRevaluationInitial()
    {
        return $this->hasMany(MedicineRevaluationInitial::class);
    }
    public function clasificationClassRevaluationRenovation()
    {
        return $this->hasMany(MedicineRevaluationRenovation::class);
    }
}
