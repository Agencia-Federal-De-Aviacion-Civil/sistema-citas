<?php

namespace App\Models\Catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeExam extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function typeExamTypeClass()
    {
        return $this->hasMany(TypeClass::class);
    }
}
