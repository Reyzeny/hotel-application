@extends('layouts.app')

@section('content')
<div class="container">

    <div>
        <p>Rooms</p>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
New Room Type
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New Room Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST", action="/room_type" enctype="multipart/form-data">
            @csrf
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name"/><br>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" id="price" name="price" class="form-control" placeholder="Price"/><br>
            <input type="text" name="features" class="form-control" placeholder="Features"/><br>
            <div class="input-group control-group increment" >
                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
            </div>
            <div class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="filename[]" class="form-control">
                    <div class="input-group-btn"> 
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
    </div>
    @foreach ($room_types as $room_type)
        
        <div class="card">
            <p>{{ $room_type->name }}</p>
            <a class="btn btn-info" href="/room_type/{{$room_type->id}}/edit">Edit</a>
            <form action="/room_type/{{$room_type->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <div>
                @foreach ($room_type->rooms as $room)
                    <p>{{ $room->number }}</p>
                    <form method="POST" action="/room/{{$room->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete room number</button>
                    </form>
                @endforeach
            </div>

            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NewRoomModal{{ $room_type->id }}">
            Add Room
            </button>

            <!-- Modal -->
            <div class="modal fade" id="NewRoomModal{{ $room_type->id }}" tabindex="-1" role="dialog" aria-labelledby="NewRoomModalTitle" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form method="POST", action="/room">
                        @csrf
                        <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Room number"/><br>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="room_type_id"  value="{{ $room_type->id }}"/>
                        <label>Available</label>
                        <input type="text" name="available" value="1"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        
        
    @endforeach

    
</div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>