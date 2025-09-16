<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassengerProfile extends Model
{
    protected $fillable = [
        'passenger_id',
        'gender',
        'passport_number',
        'passport_expiry',
        'nationality',
        'date_of_birth',
        'national_id',
        'phone_number'
    ];

    // Inverse relationship
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }
}
