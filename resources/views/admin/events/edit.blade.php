@extends('layouts.app')

@section('content')
    <div class="container w-75 mx-auto">
        <h1>EDIT Event</h1>
        <hr>
        <form method="post" action="{{route('admin.events.update', ['id' => $event->id])}}">
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mx-sm-3" id="name" name="name" placeholder="Name"
                           value="{{$event->name}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Detail</label>
                    <input type="detail" class="form-control mx-sm-3" id="detail" name="detail" placeholder="Detail"
                           value="{{$event->detail}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Precondition</label>
                    <input type="precondition" class="form-control mx-sm-3" id="precondition" name="precondition" placeholder="Precondition"
                           value="{{$event->precondition}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Location</label>
                    <input type="location" class="form-control mx-sm-3" id="location" name="location" placeholder="Location"
                           value="{{$event->location}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Category</label>
                    <input type="category_id" class="form-control mx-sm-3" id="category_id" name="category_id" placeholder="Category"
                           value="{{$event->category_id}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Max_capacity</label>
                    <input type="max_capacity" class="form-control mx-sm-3" id="max_capacity" name="max_capacity" placeholder="Max_capacity"
                           value="{{$event->max_capacity}}">
                </div>
            </div>
 
            <div class="form-row">
                <div class="col-sm-1 my-3">
                    	<button type="submit" class="btn btn-primary form form-control mx-sm-3" > Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection