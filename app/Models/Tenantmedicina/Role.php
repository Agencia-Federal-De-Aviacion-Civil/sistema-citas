<?php

namespace App\Models\Tenantmedicina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $connection = 'mysql-tenant';
    protected $table = 'model_has_roles';
    protected $guarded = ['id'];
}
