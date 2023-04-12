<?php

namespace App\Models\Medicine;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function medicineDocument()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
