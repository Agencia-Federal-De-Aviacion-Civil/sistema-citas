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
    public function userHeadquarterUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
