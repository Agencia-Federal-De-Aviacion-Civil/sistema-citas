<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataMedReservationExt extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql-tenant';
    protected $table = 'med_reservation_exts';
    protected $guarded = ['id'];

}
