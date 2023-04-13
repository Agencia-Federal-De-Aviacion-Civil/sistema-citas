<?php

namespace App\Models;

use App\Models\Medicine\Medicine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function documentMedicine()
    {
        return $this->hasMany(Medicine::class);
    }
}
