<?php

namespace Pmptadl;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','firstName' ,
            'lastName' ,
            'address' ,
            'phone' ,
            'organization' ,
            'title',
            'officeAddress' ,
            'officePhone' ,
            'userType'     
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function organizations(){
        return $this->hasOne('Pmptadl\Organizations');
    }
}
