<?php

namespace App\Models;

use App\Models\appointment\userAppointment;
use App\Models\appointment\UserParticipant;
use App\Models\catalogue\headquarter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
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
        'apParental',
        'apMaternal',
        'genre',
        'birth',
        'state_id',
        'municipal_id',
        'age',
        'street',
        'nInterior',
        'nExterior',
        'suburb',
        'postalCode',
        'federalEntity',
        'delegation',
        'mobilePhone',
        'officePhone',
        'extension',
        'curp',
        'email',
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
    public function userParticipant()
    {
        return $this->hasMany(UserParticipant::class);
    }
    public function userAppointment()
    {
        return $this->hasMany(userAppointment::class);
    }
    public function userHeadquarter()
    {
        return $this->hasMany(headquarter::class);
    }
}
