<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'type',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function name()
    {
        return $this->profile->firstname.' '.$this->profile->lastname;
    } 

    public function profile()
    {
        return $this->hasOne('App\Models\UserProfile', 'user_id');
    } 

    public function organization()
    {
        return $this->hasOne('App\Models\UserOrganization', 'user_id');
    } 

    public function researcher()
    {
        return $this->hasOne('App\Models\Researcher', 'user_id');
    } 

    public function attendees()
    {
        return $this->hasMany('App\Models\EventAttendance', 'user_id');
    } 

    public function getUpdatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y g:i a', strtotime($value));
    }

    public function sendWelcomeNotification(\Carbon\Carbon $validUntil)
    {
        $this->notify(new WelcomeNotification($validUntil));
    }

    public function hasRole($roles)
    {
        foreach ($roles as $role) {
            if ($this->type == $role) {
                return true;
            }
        }
        return false;
    }

}
