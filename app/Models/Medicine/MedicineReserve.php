<?php

namespace App\Models\Medicine;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReserve extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineReserveFromUser()
    {
        return $this->belongsTo(User::class, 'from_user_appointment');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'to_user_headquarters');
    }
}
