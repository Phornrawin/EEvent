@extends('layouts.master')

@section('title', 'Edit Event - EEvent');

@section('content');
<script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk&callback=initMap">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/map.css')}}">

<div class="container">
    <div class="row">
        <h1>Edit your event here!</h1>
    </div>

    <div class="row">
        <form method="post" class="contact1-form validate-form" action="{{route('events.update', ['id'=>$event->id])}}">
            @method('PUT')
            {{ csrf_field() }}


            <div class="row">
                <div class="form-group">
                    <label>Event name:</label>
                    <input type="text" name="name" value="{{$event->name}}" class="form-control"
                           size="100">
                    @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif

                    <label>Category </label>

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
                        <span class="help-block">{{ $errors->first('category') }}</span>
                    @endif
                </div>
            </div>

            <div class="row">

                <label>Maximum Attendee:<input type="number" name="max_capacity" value="{{$event->max_capacity}}"
                                               min="0" class="form-control"></label>
                @if($errors->has('max_capacity'))
                    <span class="help-block">{{ $errors->first('max_capacity') }}</span>
                @endif
                <label>Event fee (Baht) <input type="number" name="price" value="{{$event->price}}"
                                               class="form-control"></label>
                @if($errors->has('price'))
                    <span class="help-block">{{ $errors->first('price') }}</span>
                @endif

                <label>Pay fee before: <input type="datetime-local" name="payment_time"
                                              class="form-control"
                                              value="{{$event->payment_time->format("Y-m-d\Th:i")}}"></label>
                @if($errors->has('payment_time'))
                    <span class="help-block">{{ $errors->first('payment_time') }}</span>
                @endif
            </div>


            <div class="row form-group">
                <label>Location <input id="location" type="textbox" name="location" value="{{$event->location}}"
                                       class="form-control" size="70"></label>
                @if($errors->has('location'))
                    <span class="help-block">{{ $errors->first('location') }}</span>
                @endif

                <input id="submit" type="button" value="Show on map" class="btn btn-dark">
            </div>

            <div id="map"></div>

            <div class="row form-group">
                <label>Event start time: <input type="datetime-local" name="start_time"
                                                class="form-control"
                                                value="{{$event->start_time->format("Y-m-d\Th:i")}}"></label>
                @if($errors->has('start_time'))
                    <span class="help-block">{{ $errors->first('start_time') }}</span>
                @endif
            </div>
            <div class="row">
                <label>Detail:<textarea name="detail" class="form-control">{{$event->detail}}</textarea></label>
                @if($errors->has('detail'))
                    <span class="help-block">{{ $errors->first('detail') }}</span>
                @endif
            </div>
            <input type="hidden" value="{{Auth::id()}}" name="organizer_id">

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection