<?php

namespace App\Models\Catalogue;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogsApi extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
}
