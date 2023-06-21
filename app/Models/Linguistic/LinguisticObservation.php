<?php

namespace App\Models\Linguistic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinguisticObservation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function observationReserve()
    {
        return $this->belongsTo(LinguisticReserve::class, 'linguistic_reserve_id');
    }

}
