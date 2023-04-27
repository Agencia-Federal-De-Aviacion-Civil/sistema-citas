<?php

namespace App\Models\Linguistic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linguistic extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function linguisticReserve()
    {
        return $this->hasMany(LinguisticReserve::class);
    }
}
