<?php

namespace App\Models\Catalogue;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function headquarterUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
