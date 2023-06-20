<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\Headquarter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineSchedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public function scheduleMedicine()
    // {
    //     return $this->hasMany(MedicineReserve::class);
    // }
    public function scheduleReserve()
    {
        return $this->hasMany(MedicineReserve::class);
    }
    public function scheduleHeadquarter()
    {
        return $this->hasMany(Headquarter::class);
    }
}
