<?php

namespace App\Models\appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userQuestion extends Model
{
    use HasFactory;
    public function questionStudying()
    {
        return $this->hasMany(userStudying::class);
    }
}
