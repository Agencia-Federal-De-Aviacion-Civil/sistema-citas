<?php

namespace App\Models\catalogue;

use App\Models\appointment\userStudying;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeClass extends Model
{
    use HasFactory;
    protected $fillable = ['type_exam_id', 'name'];
    public function classExam()
    {
        return $this->belongsTo('App\Models\catalogue\typeExam', 'type_exam_id');
    }
    public function classStudying()
    {
        return $this->hasMany(userStudying::class);
    }
}
