<?php

namespace App\Models\Tenantmedicina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedRservationReas extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql-tenant';
    protected $table = 'med_reservation_reasses';
    protected $guarded = ['id'];
}
