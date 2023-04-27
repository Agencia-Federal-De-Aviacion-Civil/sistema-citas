<?php

namespace App\Models\Linguistic;

use App\Models\Catalogue\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinguisticReserve extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function reserveLinguistic()
    {
        return $this->belongsTo(Linguistic::class, 'linguistic_id');
    }
    public function reserveSchedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
