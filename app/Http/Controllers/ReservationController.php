<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Booking;
use App\BookingRoom;

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
        $room_type_count = Room::where([
            ['room_type_id', $room_type_id],
            ['available', true]
            ])->get()->count();
        
        if ($room_type_count < $request->no_of_rooms) {
            return response()->json(['msg'=>'limited room'], 400);
        }
        //return ['ms'=>"count is $room_type_count"];
        
        
        $booking = new Booking();
        $booking->customer_id = $request->customer_id;
        $booking->room_type_id = $request->room_type_id;
        $booking->no_of_rooms = $request->no_of_rooms;
        $booking->no_of_persons = $request->no_of_persons;
        $booking->amount = $request->amount;
        $booking->transaction_ref = $request->transaction_ref;
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->save();

        
        for ($i=0; $i<$request->no_of_rooms; $i++){
            $room = Room::where([
                ['room_type_id', $room_type_id],
                ['available', true]
            ])->inRandomOrder()->first();
            $room->available = false;
            $room->save();

            $booking_rooms = new BookingRoom();
            $booking_rooms->booking_id = $booking->id;
            $booking_rooms->room_number = $room->number;
            $booking_rooms->save();
        }

        return response()->json(['booking'=>$booking]);

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
        $room = Room::find($id);
        $room->available = !$room->available;
        $room->save();
        return redirect()->back();
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
        //echo "id is $id";
        $booking = Booking::find($id);
        $booking->checked_out = true;
        $booking->save();

        $booking_rooms = BookingRoom::where('booking_id', $booking->id)->get();
        foreach($booking_rooms as $booked_room) {
            $room = Room::where('number', $booked_room->room_number)->first();
            $room->available = true;
            $room->save();
        }
        return redirect()->back();
    }

    public function getuserbookings($user_id) {
        $recentbookings = Booking::where([
            ['customer_id', $user_id],
            ['checked_out', false]
        ])->get()->load('room_type')->load('customer');
        $pastbookings = $this->getpastuserbookings($user_id);
        return ['recent'=>$recentbookings, 'past'=>$pastbookings];
    }

    public function getpastuserbookings($user_id) {
        $pastbookings = Booking::where([
            ['customer_id', $user_id],
            ['checked_out', true]
        ])->get()->load('room_type')->load('customer');
        return $pastbookings;
    }

    public function check_in(Request $request, $booking_id) {
        $booking = Booking::find($booking_id);
        $booking->checked_in = true;
        $booking->save();
        return redirect()->back();
    }
    public function check_out(Request $request, $booking_id) {
        $booking = Booking::find($booking_id);
        $booking->checked_out = true;
        $booking->save();

        $booking_rooms = BookingRoom::where('booking_id', $booking->id)->get();
        foreach($booking_rooms as $booking_room) {
            $room = Room::where('number', $booking_room->room_number)->first();
            $room->available = true;
            $room->save();
        }
        return redirect()->back();
        return redirect()->back();
    }

    public function cancel_booking(Request $request, $booking_id) {
        $booking = Booking::find($booking_id);
        $booking->checked_in = true;
        $booking->checked_out = true;
        $booking->save();

        $booking_rooms = BookingRoom::where('booking_id', $booking->id)->get();
        foreach($booking_rooms as $booking_room) {
            $room = Room::where('number', $booking_room->room_number)->first();
            $room->available = true;
            $room->save();
        }
        return redirect()->back();
    }
    
}
