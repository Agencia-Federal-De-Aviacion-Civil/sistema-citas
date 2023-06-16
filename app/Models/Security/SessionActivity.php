<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionActivity extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
