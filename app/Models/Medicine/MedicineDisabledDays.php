<?php

namespace App\Models\Medicine;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDisabledDays extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function disabledDaysUser()
    {
        return $this->belongsTo(User::class, 'user_headquarters_id');
    }
}
