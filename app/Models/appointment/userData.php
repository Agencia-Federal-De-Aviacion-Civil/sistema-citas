<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userData extends Model
{
    use HasFactory;
    protected $fillable = ['headquarter_id','data','count'];
}
