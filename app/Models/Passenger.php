<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;




class Passenger extends Authenticatable
{
    protected $fillable = [
        
        'first_name',
        'last_name',
        'email',
        'password',
        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(PassengerProfile::class);
    }


   
    
}
