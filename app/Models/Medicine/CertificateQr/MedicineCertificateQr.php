<?php

namespace App\Models\Medicine\CertificateQr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MedicineCertificateQr extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $guarded = ['id'];
}
