<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
    public function rooms() {
        return $this->hasMany('App\BookingRoom', 'booking_id', 'id');
    }
    public function room_type() {
        return $this->hasOne('App\RoomType', 'id', 'room_type_id');
    }
}
