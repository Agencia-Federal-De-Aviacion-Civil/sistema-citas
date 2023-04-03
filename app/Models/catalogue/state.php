<?php

namespace App\Models\catalogue;

use App\Models\appointment\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
    public function stateParticipant()
    {
        return $this->hasMany(UserParticipant::class);
    }
    public function stateMunicipal()
    {
        return $this->hasMany(municipal::class);
    }
}
