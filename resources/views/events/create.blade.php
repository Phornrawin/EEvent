@extends('layouts.master')

@section('title', 'Create an Event - EEvent');

@section('content')
    <script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk&callback=initMap">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/enter_button_controller.js') }}"></script>

    <link rel="stylesheet" href="{{asset('css/map.css')}}">

    <div class="container" onload="initMap()">
        @if ($errors->any())
        <script>swal("Error!", "{{$errors->first('error')}}", "error");</script>
        @endif
    
            <h1>Create your event here!</h1>
        <div class="form-group">
            <form method="post" class="contact1-form validate-form" action="{{route('events.store')}}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Select cover image</label>
                    <input type="file" class="form-control" name="image_path">
                </div>

                <div class="form-group">
                    <label>Event name
                        <input type="text" name="name" placeholder="Name" class="form-control"
                               size="50"></label>
                    @if($errors->has('name'))
                        <span class="help-block alert alert-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Precondition<textarea id="precondition" name="precondition" class="form-control" row="20"
                                                 cols="50" style="height:100px"></textarea></label>
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
                        <option value="1">Adventure</option>
                        <option value="2">Dance</option>
                        <option value="3">Movement</option>
                        <option value="4">Food</option>
                        <option value="5">Movie</option>
                        <option value="6">Other</option>
                    </select>
                    @if($errors->has('category_id'))
                        <span class="help-block alert alert-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Maximum Attendee:<input type="number" name="max_capacity" placeholder="Attendee number"
                                                   min="0" class="form-control"></label>
                    @if($errors->has('max_capacity'))
                        <span class="help-block alert alert-danger">{{ $errors->first('max_capacity') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Event fee (Baht) <input type="number" name="price" min="0"
                                                   class="form-control"></label>
                    @if($errors->has('price'))
                        <span class="help-block alert alert-danger mb-md-2">{{ $errors->first('price') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Pay fee before <input type="datetime-local" name="payment_time"
                                                  class="form-control"></label>
                    @if($errors->has('payment_time'))
                        <span class="help-block alert alert-danger">{{ $errors->first('payment_time') }}</span>
                    @endif
                </div>
                <div class="form-group text-center d-flex justify-content-center">
                    <label>Location <input id="location" type="textbox" name="location" placeholder="Location"
                                           class="form-control" size="70"></label>
                    @if($errors->has('location'))
                        <span class="help-block alert alert-danger">{{ $errors->first('location') }}</span>
                    @endif

                    <input id="submit" type="button" value="Show on map" class="btn btn-dark">
                </div>

                <div id="map"></div>

                <div class="form-group">

                    <label>Event start time <input type="datetime-local" name="start_time"
                                                   class="form-control"></label>
                    @if($errors->has('start_time'))
                        <span class="help-block alert alert-danger">{{ $errors->first('start_time') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Detail<textarea id="detail" name="detail" class="form-control" row="20" cols="100"
                                           style="height:200px"></textarea></label>
                    @if($errors->has('detail'))
                        <span class="help-block alert alert-danger">{{ $errors->first('detail') }}</span>
                    @endif
                </div>


                <input type="hidden" value="{{Auth::id()}}" name="organizer_id">

                <button type="submit" class="btn btn-primary">Create!</button>
            </form>

        </div>
    </div>

@endsection