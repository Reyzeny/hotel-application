<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //echo "hello there";
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $room_type_id = $request->room_type_id;
        $room = Room::where([
                ['room_type_id', $room_type_id],
                ['available', true]
            ])->inRandomOrder()->first();
        $room->available = false;
        $room->save();

        $booking = new Booking();
        $booking->customer_id = $request->customer_id;
        $booking->room_number = $room->number;
        $booking->noOfRooms = $request->noOfRooms;
        $booking->noOfPersons = $request->noOfPersons;
        $booking->amount = $request->price;
        $booking->transactionRef = $request->transactionRef;

        $booking->save();
        return $room;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
