<?php

namespace App\Models\Medicine\CertificateQr;

use App\Models\Document;
use App\Models\Medicine\MedicineReserve;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineCertificateQr extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function certificateQrMedicineReserve(){
        return $this->belongsTo(MedicineReserve::class,'medicine_reserves_id');
    }
    public function certificateQrDocument()
    {
        return $this->belongsTo(Document::class, 'document_license_id');
    }
}
