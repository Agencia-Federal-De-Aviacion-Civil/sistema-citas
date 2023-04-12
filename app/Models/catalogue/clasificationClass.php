<?php

namespace App\Models\Catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasificationClass extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function clasificationClassTypeClass()
    {
        return $this->belongsTo(TypeClass::class, 'type_class_id');
    }
}
