<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\Headquarter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDisabledDays extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function disabledDaysHeadquarter()
    {
        return $this->belongsTo(Headquarter::class, 'headquarter_id');
    }
}
