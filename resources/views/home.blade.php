@extends('layouts.app')

@section('content')
<div class="container">
    <div>
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
                        <form method="POST" action="/room_type" enctype="multipart/form-data">
                            @csrf
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required/><br>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            
                            <div class="row room-number-row"><span class="col-sm-1">=N=</span><div class="col-sm-11"><input type="text" id="price" name="price" class="form-control" placeholder="Price" onkeyup="this.value = this.value.replace(/[^0-9]/, '')" required/></div></div><br>
                            <input type="text" name="features" class="form-control" placeholder="Features" required/><br>
                            <div class="input-group control-group increment" >
                                <input type="file" name="filename[]" class="form-control" required>
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
        <!-- End of modal -->
    </div>
    @foreach ($room_types as $room_type)
    <div class="card room-type-card">
        <!-- card headers -->
        <div class="row">
            <div class="col-sm-10">
                <h3>{{ $room_type->name }}</h3>
            </div>
            <div class="col-sm-1">
                <span><a class="btn btn-info" href="/room_type/{{$room_type->id}}/edit"><i class="fa fa-edit" style="font-size:16px; color: white;"></i></a></span>
            </div>
            <div class="col-sm-1">
                <span>
                    <form action="/room_type/{{$room_type->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fa fa-trash" style="font-size:16px; color: white;"></i></button>
                    </form>
                </span>
            </div>
            <div>
                <img src="images/{{$room_type->images[0]->image_name}}" class="room-image"/>
            </div>
        </div>
        <!-- End of card header -->
        <div>
            <p>Room numbers</p>
            @foreach ($room_type->rooms as $room)
            <div class="row room-number-row">
                <div class="col-sm-10">
                    {{ $room->number }}
                </div>
                <div class="col-sm-2 close">
                    
                    <form method="POST" action="/room/{{$room->id}}">
                        @csrf
                        @method('DELETE')
                        <span><button type="submit" class="btn btn-danger"><i class="material-icons" style="font-size:20px;color:#FFFFFF;">highlight_off</i></button></span>
                    </form>
                </div>
            </div>
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
                        <form method="POST" action="/room">
                            @csrf
                            <label for="number">Enter room number:</label>
                            <input type="text" id="number" name="number" class="form-control @error('number') is-invalid @enderror" placeholder="Room number" required/><br>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label>Select Room availability:</label><br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-success active">
                                    <input type="radio" name="available" id="option1" autocomplete="off" value="1" checked> Available
                                </label>
                                <label class="btn btn-success">
                                    <input type="radio" name="available" id="option2" value="0" autocomplete="off"> Not Available
                                </label>
                            </div>
                            <input type="hidden" name="room_type_id"  value="{{ $room_type->id }}"/>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal -->
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

<style lang="scss">
.room-type-card {
    margin-top: 20px;
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
.card .card-action a {
  color: #ffab40;
  margin-right: 16px;
  transition: color 0.3s ease;
  text-transform: uppercase;
}
.card .card-action a:hover {
  color: #ffd8a6;
  text-decoration: none;
}

.room-number-row{
    padding: 1px;
    align-items: center;
}
.room-number-row:hover{
    background-color: rgb(192,192,192);
    
    border-radius: 20px;
    color: white;
}

.room-image {
    width: 100%;
    height: 50%;
}
.hide {
    display: none;
}
</style>