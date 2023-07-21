<?php

namespace App\Models;

use App\Models\Catalogue\Headquarter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHeadquarter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function userHeadquarterHeadquarter()
    {
        return $this->belongsTo(Headquarter::class, 'headquarter_id');
    }
    public function userHeadquarterUserParticipant()
    {
        return $this->belongsTo(UserParticipant::class, 'user_participant_id');
    }
}
