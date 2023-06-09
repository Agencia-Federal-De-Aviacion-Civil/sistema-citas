<?php

namespace App\Models\Medicine;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicine_history_movements extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function historyUser(){
        return $this->belongsTo(User::class);
    }
}
