<?php

namespace App\Models\catalogue;

use App\Models\appointment\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipal extends Model
{
    use HasFactory;
    public function municipalParticipant()
    {
        return $this->hasMany(UserParticipant::class);
    }
    public function municipalState()
    {
        return $this->belongsTo(state::class, 'state_id');
    }
}
