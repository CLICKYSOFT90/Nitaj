<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'is_admin',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['registrationSteps', 'nationalIdVeriification', 'generalInfos', 'financialStatus', 'usersWallet'];


    public function registrationSteps()
    {
        return $this->hasMany(RegistrationStep::class, 'user_id')->latest();
    }
    public function nationalIdVeriification()
    {
        return $this->hasMany(NationalIdVerification::class, 'user_id')->latest();
    }
    public function generalInfos()
    {
        return $this->hasOne(GeneralInfo::class, 'user_id')->latest();
    }
    public function financialStatus()
    {
        return $this->hasOne(FinancialStatus::class, 'user_id')->latest();
    }
    public function usersWallet()
    {
        return $this->hasOne(UserWallets::class, 'user_id');
    }
    public function usersInvestments()
    {
        return $this->hasMany(InvestorInvestments::class, 'user_id');
    }
}
