<?php

namespace App\Models\catalogue;

use App\Models\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countrie extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    // public function userParticipants(): HasOne
    // {
    //     return $this->hasOne(related: UserParticipant::class);
    // }
}
