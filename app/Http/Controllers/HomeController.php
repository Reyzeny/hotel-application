<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoomType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $room_types = RoomType::all();
        //echo "room types is ".$room_types;
        // foreach($room_types as $room_type){
        //     echo $room_type->rooms;
        // }
        return view('home', ['room_types'=>$room_types->load('images')]);
        
    }
}
