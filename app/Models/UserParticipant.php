<?php

namespace App\Models;

use App\Models\Catalogue\Country;
use App\Models\Catalogue\Municipal;
use App\Models\Catalogue\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserParticipant extends Model
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
    public function participantState()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function participantMunicipal()
    {
        return $this->belongsTo(Municipal::class, 'municipal_id');
    }
    public function userParticipantUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userParticipantUserHeadquarter()
    {
        return $this->hasMany(UserHeadquarter::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
