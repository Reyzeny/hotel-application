<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    protected $guarded = [];
    
    public function rooms() {
        return $this->hasMany('App\Room', 'room_type_id', 'id');
    }

    public function images() {
        return $this->hasMany('App\RoomTypeImage', 'room_type_id', 'id');
    }
}
