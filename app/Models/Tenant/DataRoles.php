<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRoles extends Model
{
    use HasFactory;
    protected $connection = 'mysql-tenant';
    protected $table = 'model_has_roles';
    protected $guarded = ['id'];

}
