<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use App\Room;

class ManageController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$dueList = Booking::where('created_at', '<=', Carbon::today())->get()->load('customer')->load('rooms');
        $dueList = Booking::whereDate('check_out_date', '<=', Carbon::today()->toDateString())
                    ->where('checked_out', false)
                    ->get()
                    ->load('customer', 'rooms', 'room_type');
        // return $dueList;
        $bookedList = Booking::where([
                ['checked_in', false],
                ['checked_out', false],
                ['check_out_date', '>', Carbon::today()->toDateString()]
            ])
            ->orWhere([
                ['checked_in', true],
                ['checked_out', false],
                ['check_out_date', '>', Carbon::today()->toDateString()]
            ])
            ->get()->load('customer', 'rooms', 'room_type');
        $availableList = Room::orderBy('number')->get()->load('room_type');
        // return $availableList;
        return view('manage', ['dueList'=>$dueList, 'bookedList'=>$bookedList, 'availableList'=>$availableList]);
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
