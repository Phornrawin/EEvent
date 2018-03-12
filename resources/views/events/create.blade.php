@extends('layouts.master')

@section('title', 'Create an Event - EEvent');

@section('content')
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/map.css')}}">

    <div class="container">
        <div class="row form-group">
            <h1>Create your event here!</h1>

        </div>
        <div class="row form-group">
            <form method="post" class="contact1-form validate-form" action="{{route('events.store')}}">
                {{ csrf_field() }}

                <div class="row form-group">
                    <label>Event name:<input type="text" name="name" placeholder="Name" class="form-control"
                                             size="50"></label>
                    @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif


                    <label>Category
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Category</label>
                            </div>
                            <select class="custom-select" id="category_selector" name="category_id">
                                <option value="" selected disabled hidden>Select category</option>
                                <option value="1">Adventure</option>
                                <option value="2">Dance</option>
                                <option value="3">Movement</option>
                                <option value="4">Food</option>
                                <option value="5">Movie</option>
                                <option value="6">Other</option>
                            </select>
                        </div>
                    </label>
                    @if($errors->has('category'))
                        <span class="help-block">{{ $errors->first('category') }}</span>
                    @endif

                </div>

                <div class="row form-group">

                    <label>Maximum Attendee:<input type="number" name="max_capacity" placeholder="Attendee number"
                                                   min="0" class="form-control"></label>
                    @if($errors->has('max_capacity'))
                        <span class="help-block">{{ $errors->first('max_capacity') }}</span>
                    @endif
                    <label>Event fee (Baht) <input type="number" name="price" placeholder="0"
                                                   class="form-control"></label>
                    @if($errors->has('price'))
                        <span class="help-block">{{ $errors->first('price') }}</span>
                    @endif

                    <label>Pay fee before: <input type="datetime-local" name="payment_time"
                                                  class="form-control"></label>
                    @if($errors->has('payment_time'))
                        <span class="help-block">{{ $errors->first('payment_time') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label>Location <input id="location" type="textbox" name="location" placeholder="Location"
                                           class="form-control" size="70"></label>
                    @if($errors->has('location'))
                        <span class="help-block">{{ $errors->first('location') }}</span>
                    @endif

                    <input id="submit" type="button" value="Show on map" class="btn btn-dark">
                </div>

                <div id="map"></div>

                <div class="row form-group">

                    <label>Event start time: <input type="datetime-local" name="start_time"
                                                    class="form-control"></label>
                    @if($errors->has('start_time'))
                        <span class="help-block">{{ $errors->first('start_time') }}</span>
                    @endif
                </div>
                <div class="row form-group">
                    <label>Detail:<textarea name="detail" placeholder="Detail" class="form-control"></textarea></label>
                    @if($errors->has('detail'))
                        <span class="help-block">{{ $errors->first('detail') }}</span>
                    @endif
                </div>
                <input type="hidden" value="{{Auth::id()}}" name="organizer_id">

                <button type="submit" class="btn btn-primary">Create!</button>
            </form>

        </div>
    </div>

@endsection