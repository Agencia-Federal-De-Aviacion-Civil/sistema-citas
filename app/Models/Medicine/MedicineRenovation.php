<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineRenovation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function renovationMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
    public function renovationTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
    public function renovationClasificationClass()
    {
        return $this->belongsTo(ClasificationClass::class, 'clasification_class_id');
    }
}
