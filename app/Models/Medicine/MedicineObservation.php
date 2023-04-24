<?php

namespace App\Models\Medicine;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineObservation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function observationReserve()
    {
        return $this->belongsTo(MedicineReserve::class, 'medicine_reserve_id');
    }

}
