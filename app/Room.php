<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $guarded = [];
    //
    public function room_type() 
    {
        return $this->belongsTo('App\RoomType', 'id', 'room_type_id');
    }
}
