<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    use HasFactory;
    public function state_municipal()
    {
        return $this->hasMany('App\Models\catalogue\municipal');
    }
    public function state_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
