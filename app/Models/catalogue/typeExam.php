<?php

namespace App\Models\catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeExam extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function examClass()
    {
        return $this->hasMany('App\Models\catalogue\typeClass');
    }
}
