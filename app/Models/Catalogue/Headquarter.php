<?php

namespace App\Models\Catalogue;

use App\Models\Medicine\MedicineDisabledDays;
use App\Models\User;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use App\Models\UserHeadquarter;
use App\Models\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                $model->{$key} = strtoupper($value);
            }
        });
    }
    public function headquarterUserParticipant()
    {
        return $this->belongsToMany(UserParticipant::class, 'user_headquarters');
    }
    public function headquarterMedicineReserve()
    {
        return $this->hasMany(MedicineReserve::class);
    }
    public function headquarterSchedule()
    {
        return $this->belongsTo(MedicineSchedule::class, 'medicine_schedule_id');
    }
    public function headquarterDisabledDays()
    {
        return $this->hasMany(MedicineDisabledDays::class);
    }
    public function HeadquarterUserHeadquarter()
    {
        return $this->hasMany(UserHeadquarter::class);
    }
}
