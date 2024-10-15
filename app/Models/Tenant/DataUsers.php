<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataUsers extends Model
{
    use HasFactory;
    protected $connection = 'mysql-tenant';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    public function userProfile(): HasOne
    {
        return $this->hasOne(DataUserProfiles::class,'user_id');
    }

}
