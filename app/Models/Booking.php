<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // table name (optional if it follows plural convention "bookings")
    protected $table = 'bookings';

    // fields you can mass-assign
    protected $fillable = [
        'passenger_id',
        'flight_id',
        'status',
    ];

    // relationships
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
