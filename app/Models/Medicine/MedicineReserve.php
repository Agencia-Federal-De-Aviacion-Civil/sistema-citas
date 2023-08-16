<?php

namespace App\Models\Medicine;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\CertificateQr\MedicineCertificateQr;
use App\Models\Observation;
use App\Models\User;
use App\Models\UserParticipant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineReserve extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function medicineReserveFromUser()
    {
        return $this->belongsTo(User::class, 'from_user_appointment');
    }
    public function medicineReserveMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
    public function medicineReserveHeadquarter()
    {
        return $this->belongsTo(Headquarter::class, 'headquarter_id');
    }
    public function reserveMedicine()
    {
        return $this->belongsTo(Medicine::class);
    }
    public function userParticipantUser()
    {
        return $this->belongsTo(UserParticipant::class, 'from_user_appointment', 'user_id');
    }
    public function reserveSchedule()
    {
        return $this->belongsTo(MedicineSchedule::class, 'medicine_schedule_id');
    }
    public function reserveObserv()
    {
        return $this->hasMany(MedicineObservation::class);
    }
    public function certificateQrMedicineReserve()
    {
        return $this->hasMany(MedicineCertificateQr::class);
    }
}
