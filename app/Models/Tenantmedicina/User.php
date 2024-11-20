<?php

namespace App\Models\Tenantmedicina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
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
        return $this->hasOne(UserProfile::class, 'user_id');
    }
}
