<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMedReservations extends Model
{
    use HasFactory;
    protected $connection = 'mysql-tenant';
    protected $table = 'med_reservations';
    protected $guarded = ['id'];

    // protected $primaryKey = 'id';

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(DataUsers::class,'user_id');
    // }

}
