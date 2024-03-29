@extends('layouts.app')

@section('content')
<h1>Manage Rooms</h1>
<section id="tabs" class="project-tab">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Due</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Booked</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Available</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @foreach($dueList as $due)
                        <div class="card">
                            <div><span class="info-title">Room number:</span> 
                            <span class="info-value">
                            @foreach($due->rooms as $room)
                                {{$room->room_number}}
                            @endforeach
                            </span>
                            </div>
                            <div><span class="info-title">Type: </span> <span class="info-value">{{$due->room_type->name}}</span></div>
                            <div><span class="info-title">Name: </span> <span class="info-value">{{$due->customer->first_name}} {{$due->customer->first_name}}</span></div>
                            <div><span class="info-title">Booking ID: </span> <span class="info-value">{{$due->id}}</span></div>
                            <form action="/reservation/{{$due->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-info">Checkout</a>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @foreach($bookedList as $booked)
                        <div class="card">
                            
                            <div><span class="info-title">Room number:</span> 
                            <span class="info-value">
                            @foreach($booked->rooms as $room)
                                {{$room->room_number}}
                            @endforeach
                            </span>
                            </div><br>
                            <div><span class="info-title">Type: </span> <span class="info-value">{{$booked->room_type->name}}</span></div><br>
                            <div><span class="info-title">Name: </span> <span class="info-value">{{$booked->customer->first_name}} {{$booked->customer->first_name}}</span></div><br>
                            <div><span class="info-title">Booking ID: </span> <span class="info-value">{{$booked->id}}</span></div><br>
                            <div class="row">
                                <div class="col-sm-6">
                                    @if (!$booked->checked_in)
                                    <form action="/booking/check_in/{{$booked->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-lg">Check in</a>
                                    </form>
                                    @else
                                    <form action="/booking/check_out/{{$booked->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-lg">Check out</a>
                                    </form>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if (!$booked->checked_in)
                                    <form action="/booking/cancel/{{$booked->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-lg">Cancel Booking</a>
                                    </form>
                                    @endif
                                </div>
                            </div>
                            
                            

                            
                        </div>
                        @endforeach
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        @foreach($availableList as $available)
                        <div class="card">
                            <div><span class="info-title" style="font-size: 20px;">Room number: </span> <span class="info-value"  style="font-size: 20px;">{{$available->number}}</span></div><br>
                            <div><span class="info-title">Type: </span> <span class="info-value">{{$available->room_type->name}}</span></div><br>
                            
                            <form action="/reservation/{{$available->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                @if($available->available)
                                <button type="submit" class="btn btn-danger">Make unavailable</a>
                                @else
                                <button type="submit" class="btn btn-info">Make available</a>
                                @endif
                            </form>
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
.project-tab {
    padding: 10%;
    margin-top: -8%;
}
.project-tab #tabs{
    background: #007b5e;
    color: #eee;
}
.project-tab #tabs h6.section-title{
    color: #eee;
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #0062cc;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 3px solid !important;
    font-size: 16px;
    font-weight: bold;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #0062cc;
    font-size: 16px;
    font-weight: 600;
}
.project-tab .nav-link:hover {
    border: none;
}
.project-tab thead{
    background: #f3f3f3;
    color: #333;
}


.card {
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
}

.card {
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 2px;
  background-clip: padding-box;
  padding: 20px;
}
.card span.card-title {
    color: #fff;
    font-size: 24px;
    font-weight: 300;
    text-transform: uppercase;
}

.card .card-image {
  position: relative;
  overflow: hidden;
}
.card .card-image img {
  border-radius: 2px 2px 0 0;
  background-clip: padding-box;
  position: relative;
  z-index: -1;
}
.card .card-image span.card-title {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 16px;
}
.card .card-content {
  padding: 16px;
  border-radius: 0 0 2px 2px;
  background-clip: padding-box;
  box-sizing: border-box;
}
.card .card-content p {
  margin: 0;
  color: inherit;
}
.card .card-content span.card-title {
  line-height: 48px;
}
.card .card-action {
  border-top: 1px solid rgba(160, 160, 160, 0.2);
  padding: 16px;
}
.info-title {
    font-weight: 500;
}
.info-value {
    color: #81C784;
}
</style>