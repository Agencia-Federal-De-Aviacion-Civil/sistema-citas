<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineInitial extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function initialMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
    public function medicineInitialQuestion()
    {
        return $this->belongsTo(MedicineQuestion::class, 'medicine_question_id');
    }
    public function medicineInitialTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
    public function medicineInitialClasificationClass()
    {
        return $this->belongsTo(ClasificationClass::class, 'clasification_class_id');
    }
}
