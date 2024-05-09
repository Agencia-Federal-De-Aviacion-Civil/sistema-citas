<?php

namespace App\Models;

// use App\Models\appointment\user_appointment_success;
// use App\Models\appointment\userAppointment;
//use App\Models\UserParticipant;
// use App\Models\catalogue\headquarter;

use App\Models\Catalogue\Headquarter;
use App\Models\Medicine\Medicine;
use App\Models\Medicine\medicine_history_movements;
use App\Models\Medicine\MedicineDisabledDays;
use App\Models\Medicine\MedicineReserve;
use App\Models\Medicine\MedicineSchedule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use App\Notifications\MyVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function UserParticipant()
    {
        return $this->hasMany(UserParticipant::class);
    }
    // public function userHeadquarter()
    // {
    //     return $this->hasMany(Headquarter::class);
    // }
    public function userMedicine()
    {
        return $this->hasMany(Medicine::class);
    }
    // public function userMedicineReserveTo()
    // {
    //     return $this->hasMany(MedicineReserve::class, 'to_user_headquarters');
    // }
    public function userHeadquarter()
    {
        return $this->belongsToMany(Headquarter::class, 'user_headquarters');
    }
    public function usermedicineReserveFrom()
    {
        return $this->hasMany(MedicineReserve::class);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token));
    }
    public function SendEmailVerificationNotification()
    {
        $this->notify(new MyVerifyEmail);
    }
    public function userHistory()
    {
        return $this->hasMany(medicine_history_movements::class);
    }
    public function UserPart()
    {
        return $this->hasOne(UserParticipant::class);
    }
    // public function userUserHeadquarter()
    // {
    //     return $this->hasMany(UserHeadquarter::class);
    // }
}
