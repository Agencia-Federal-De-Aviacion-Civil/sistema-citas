<?php

namespace App\Models\Linguistic;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinguisticHistoryMovements extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function historyUserLinguistic(){
        return $this->belongsTo(User::class,'user_id');
    }
}
