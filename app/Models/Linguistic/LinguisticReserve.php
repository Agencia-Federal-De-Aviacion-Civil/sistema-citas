<?php

namespace App\Models\Linguistic;

use App\Models\Catalogue\Schedule;
use App\Models\Medicine\Medicine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinguisticReserve extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function linguisticReserveFromUser()
    {
        return $this->belongsTo(User::class, 'from_user_appointment');
    }
    public function linguisticReserve()
    {
        return $this->belongsTo(Linguistic::class, 'linguistic_id');
    }
    public function linguisticReserveSchedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
    public function linguisticUserHeadquers()
    {
        return $this->belongsTo(User::class, 'to_user_headquarters');
    }
}
