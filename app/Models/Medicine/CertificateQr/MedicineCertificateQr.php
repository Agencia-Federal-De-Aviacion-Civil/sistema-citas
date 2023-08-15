<?php

namespace App\Models\Medicine\CertificateQr;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineCertificateQr extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function certificateQrDocument()
    {
        return $this->belongsTo(Document::class, 'document_license_id');
    }
}
