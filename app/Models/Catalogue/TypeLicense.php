<?php

namespace App\Models\Catalogue;

use App\Models\Linguistic\Linguistic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeLicense extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function typeLicenseLinguistic()
    {
        return $this->hasMany(Linguistic::class);
    }
}
