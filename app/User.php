<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Savannabits\AdminAuth\Activation\Traits\CanActivate;
use Savannabits\AdminAuth\Notifications\ResetPassword;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use CanActivate,HasRoles,HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'username',
        'first_name',
        'middle_name',
        'last_name'
    ];
    protected $searchable = [
        "id",
        'name',
        'email',
        'username',
        'first_name',
        'middle_name',
        'last_name',
    ];

    protected $hidden = [
        'password',
        'remember_token',

    ];

    protected $dates = [
        'email_verified_at',
        'created_at',
        'updated_at',
        'last_login_at',
        'deleted_at',

    ];



    protected $appends = ['full_name', 'resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/users/'.$this->getKey());
    }

    public function getFullNameAttribute() {
        return "$this->first_name ". ($this->middle_name ? "$this->middle_name ": "")."$this->last_name";
    }
    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(app( ResetPassword::class, ['token' => $token]));
    }

    /* ************************ RELATIONS ************************ */
}
