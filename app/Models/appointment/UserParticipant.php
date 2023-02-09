<?php

namespace App\Models\appointment;

use App\Models\catalogue\municipal;
use App\Models\catalogue\state;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserParticipant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function participantUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function participantState()
    {
        return $this->belongsTo(state::class, 'state_id');
    }
    public function participantMunicipal()
    {
        return $this->belongsTo(municipal::class, 'municipal_id');
    }
}
