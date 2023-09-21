<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\ClasificationClass;
use App\Models\Catalogue\TypeClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReservesExtension extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function extensionMedicineReserve()
    {
        return $this->belongsTo(MedicineReserve::class, 'medicine_reserve_id');
    }
    public function extensionTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_extension_id');
    }
    public function extensionClasificationClass()
    {
        return $this->belongsTo(ClasificationClass::class, 'clas_class_extension_id');
    }
}
