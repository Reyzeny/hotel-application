@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h2>Edit Room Type</h2>
    </div>
    <div class="row form-row">
        <form action="/room_type/{{$id}}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Name</label><br>
            <input type="text" class="form-control" name="name" placeholder="Room type name" value="{{$room_type->name}}"/><br>
            <label for="price">Price</label><br>
            <input type="text" id="price" name="price" class="form-control" placeholder="Price" value="{{$room_type->price}}"/><br>
            <label for="features">Features</label><br>
            <input type="text" name="features" class="form-control" placeholder="Features" value="{{$room_type->features}}"/><br>

            
            <button type="button" class="btn btn-secondary">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
            
        </form>
    </div>
</div>
@endsection


<style>
.form-row{
    margin-top:20px;
}
</style>