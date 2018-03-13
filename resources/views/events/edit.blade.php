@extends('layouts.master')

@section('title', 'Edit Event - EEvent')

@section('content')
<br>
<br>
<script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/enter_button_controller.js') }}"></script>

<link rel="stylesheet" href="{{asset('css/map.css')}}">

<div class="container" onload="initMap()">
        @if ($errors->any())
        <script>swal("Error!", "{{$errors->first()}}", "error");</script>
        @endif
    <h1>Edit your event here!</h1>
    <img class="card-img-top vignette"
             src="/uploads/events_pic/{{$event->getPicture()}}"
             alt="Card image cap" style="width: 100%; display: block;">
    <div class="form-group">
        <form method="post" class="contact1-form validate-form" action="{{route('events.update', ['id'=>$event->id])}}"
              enctype="multipart/form-data">
            @method('PUT')
            {{ csrf_field() }}

            <div class="form-group">
                <label>Select cover image</label>
                <input type="file" class="form-control" name="image_path">
            </div>

            <div class="form-group">
                <label>Event name</label>
                <input type="text" name="name" value="{{$event->name}}" class="form-control"
                       size="100">
                @if($errors->has('name'))
                    <span class="help-block alert alert-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Precondition<textarea id="precondition" name="precondition" class="form-control" row="20"
                                             cols="50" style="height:100px">{{$event->precondition}}</textarea></label>
                @if($errors->has('precondition'))
                    <span class="help-block alert alert-danger">{{ $errors->first('precondition') }}</span>
                @endif
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Category</label>
                </div>
                <select class="custom-select" id="category_selector" name="category_id">
                    <option value="" selected disabled hidden>Select category</option>
                    <option value="1" {{($event->category_id == 1?"selected":"")}}>Adventure</option>
                    <option value="2" {{($event->category_id == 2?"selected":"")}}>Dance</option>
                    <option value="3" {{($event->category_id == 3?"selected":"")}}>Movement</option>
                    <option value="4" {{($event->category_id == 4?"selected":"")}}>Food</option>
                    <option value="5" {{($event->category_id == 5?"selected":"")}}>Movie</option>
                    <option value="6" {{($event->category_id == 6?"selected":"")}}>Other</option>
                </select>
            </div>
            @if($errors->has('category'))
                <span class="help-block alert alert-danger">{{ $errors->first('category') }}</span>
            @endif


            <div class="form-group">
                <label>Maximum Attendee:<input type="number" name="max_capacity" value="{{$event->max_capacity}}"
                                               min="0" class="form-control"></label>
                @if($errors->has('max_capacity'))
                    <span class="help-block alert alert-danger">{{ $errors->first('max_capacity') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Event fee (Baht) <input type="number" name="price" value="{{$event->price}}"
                                               class="form-control"></label>
                @if($errors->has('price'))
                    <span class="help-block alert alert-danger">{{ $errors->first('price') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label>Pay fee before <input type="datetime-local" name="payment_time"
                                             class="form-control"
                                             value="{{$event->payment_time->format("Y-m-d\Th:i")}}"></label>
                @if($errors->has('payment_time'))
                    <span class="help-block alert alert-danger">{{ $errors->first('payment_time') }}</span>
                @endif
            </div>


            <div class="form-group text-center d-flex justify-content-center">
                <label>Location <input id="location" type="textbox" name="location" value="{{$event->location}}"
                                       class="form-control align-self-center" size="70"></label>
                @if($errors->has('location'))
                    <span class="help-block alert alert-danger">{{ $errors->first('location') }}</span>
                @endif

                <input id="submit" type="button" value="Show on map" class="btn btn-dark">
            </div>

            <div id="map"></div>

            <div class="form-group">
                <label>Event start time: <input type="datetime-local" name="start_time"
                                                class="form-control"
                                                value="{{$event->start_time->format("Y-m-d\Th:i")}}"></label>
                @if($errors->has('start_time'))
                    <span class="help-block alert alert-danger">{{ $errors->first('start_time') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Detail:<textarea name="detail" class="form-control" row="20" cols="100"
                                        style="height:200px">{{$event->detail}}</textarea></label>
                @if($errors->has('detail'))
                    <span class="help-block alert alert-danger">{{ $errors->first('detail') }}</span>
                @endif
            </div>


            <input type="hidden" value="{{Auth::id()}}" name="organizer_id">

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection