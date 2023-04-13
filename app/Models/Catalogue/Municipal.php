<?php

namespace App\Models\Catalogue;

use App\Models\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function municipalState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function municipalParticipant()
    {
        return $this->hasMany(UserParticipant::class);
    }
}
