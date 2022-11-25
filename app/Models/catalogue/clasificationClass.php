<?php

namespace App\Models\catalogue;

use App\Models\appointment\userRenovation;
use App\Models\appointment\userStudying;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clasificationClass extends Model
{
    use HasFactory;
    public function clasificationStudying()
    {
        return $this->hasMany(userStudying::class);
    }
    public function clasificationRenovation()
    {
        return $this->hasMany(userRenovation::class);
    }
}
