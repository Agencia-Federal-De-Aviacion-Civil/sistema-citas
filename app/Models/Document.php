<?php

namespace App\Models;

use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\MedicineRevaluation;
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
    public function documentRevaluation()
    {
        return $this->hasMany(MedicineRevaluation::class, 'document_revaloration_id');
    }
    public function documentCertificateQr()
    {
        return $this->hasOne(MedicineCertificateQr::class, 'document_license_id');
    }
}
