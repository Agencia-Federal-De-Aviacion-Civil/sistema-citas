<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\TypeExam;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function medicineDocument()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
    public function medicineTypeExam()
    {
        return $this->belongsTo(TypeExam::class, 'type_exam_id');
    }
    public function medicineInitial()
    {
        return $this->hasMany(MedicineInitial::class);
    }
    public function medicineReserve()
    {
        return $this->hasMany(medicineReserve::class);
    }

}
