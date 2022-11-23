<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipal extends Model
{
    use HasFactory;
    public function municipal_state()
    {
        return $this->belongsTo('App\Models\catalogue\state', 'state_id');
    }
    public function municipal_user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
