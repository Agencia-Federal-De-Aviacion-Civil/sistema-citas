<?php

namespace App\Models\Catalogue;

use App\Models\Linguistic\LinguisticReserve;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scheduleUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scheduleReserve()
    {
        return $this->hasMany(LinguisticReserve::class);
    }
}
