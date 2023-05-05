<?php

namespace App\Models\Catalogue;

use App\Models\User;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarter extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                $model->{$key} = strtoupper($value);
            }
        });
    }
    public function headquarterUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicicenereservaBank()
    {
        return $this->hasMany(MedicineReserve::class,'to_user_headquarters','user_id');
    }
}
