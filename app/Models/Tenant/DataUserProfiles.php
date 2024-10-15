<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataUserProfiles extends Model
{
    use HasFactory;

    protected $connection = 'mysql-tenant';
    protected $table = 'user_profiles';
    protected $guarded = ['id'];

    // protected $primaryKey = 'id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(DataUsers::class,'user_id');
    }

}
