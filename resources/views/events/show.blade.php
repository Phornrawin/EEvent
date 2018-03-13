@extends('layouts.master')

@section('content')

    <script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk&callback=initMap">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/map.css')}}">

    @include('components.modal_alert')

    <div class="jumbotron">
        <div class="container">
            <div class="jumbotron p-3 p-md-5 text-white rounded bg-danger">
                <div class="row px-3 justify-content-between">
                    <div class="col-md-6 px-0">
                        <h2><span class="badge badge-info badge-pill display-4">{{$event->category->name}}</span></h2>
                        <h1 class="display-5 font-weight-bold">{{$event->name}}</h1>
                        <div class="d-flex">
                            <div class="lead my-3 mr-3">
                                <div class="card">
                                    <div class="card-header  text-danger text-center py-2">
                                        <h3 class="font-weight-bold"
                                            style="font-family: Verdana,sans-serif">{{$event->start_time->day}}</h3>
                                    </div>
                                    <div class="card- text-dark text-center">
                                        {{$event->start_time->format('M')}}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="lead mt-3">Hosted by {{$event->organizer->name}}</div>
                                <p class="lead mb-0 text-light lato">Start at {{$event->getFormattedDay()}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 px-0">
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="card-subtitle py-3 text-muted font-weight-light"><span
                                            class="badge badge-danger  mx-2">{{$event->getPriceText()}}</span></h4>
                                <div class="row px-3 align-items-center justify-content-between">
                                    <h2 class="text-dark font-weight-bold mx-2 ">{{Auth::id() == $event->organizer_id ? 'Hosted by you' :'Are you going ?'}} </h2>
                                    <span class="text-muted mr-2">{{$event->cur_capacity}} people going</span>
                                </div>

                            </div>
                            <div class="card-footer">
                                {{--edit button for organizer--}}
                                @auth
                                    @if(!$event->isAttend(Auth::id()))
                                        <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                                            @csrf
                                            <button class="btn btn-info w-100 font-weight-bold"><i
                                                        class="fa fa-check"></i></button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                                            @csrf
                                            <button class="btn btn-danger w-100 font-weight-bold">X</button>
                                        </form>
                                    @endif
                                    @if($event->isAttend(Auth::id()) and $event->price != 0)
                                        @if($event->getPaymentStatus(Auth::id(), $event->id) == 'unpaid'))
                                        <form method="post" action="">
                                            @csrf
                                            <button class="btn btn-success w-100 font-weight-bold">Pay Entry Fee
                                            </button>
                                        </form>
                                        @else
                                            <button class="btn btn-danger w-100 font-weight-bold disabled">Paid</button>
                                        @endif
                                    @endif
                                @endauth
                                @guest
                                    <a class="btn btn-outline-dark text-dark w-100 font-weight-bold disabled">You need
                                        to login first</a>
                                @endguest

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container d-flex justify-content-around py-5">
        <div class="col-md-7">
            <img class="img-fluid my-3 box-shadow border border-dark"
                 src="/uploads/events_pic/{{$event->getPicture()}}">
            <hr>
            <div class="py-3">
                <h4>What it is about</h4>
                <p>{{$event->detail}}</p>
            </div>
            <div class="py-3 stripe">
                <h4>What you need to know</h4>
                <p>{{$event->precondition}}</p>
            </div>
            <h4 class="mt-3">Attendees ({{count($event->attendees)}})</h4>
            <div class="row mt-3">
                @foreach($event->attendees as $attendee)
                    <div class="card mx-1 rounded" style="min-width: 150px">
                        <div class="card-img-top text-center py-3">
                            <a class="d-block"><img
                                        src="{{asset('/uploads/avatars/'. $attendee->user->avatar)}}"
                                        style="max-width: 72px; max-height: 72px; width: 100%; border-radius: 50%; border: 4px solid white"></a>
                        </div>
                        <div class="card-header text-center text-truncate">
                            <p class="text-truncate">{{$attendee->user->name}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h3>Location</h3>
            <div class="card ">
                <div class="card-header bg-white">
                    <div class="d-flex">
                        <i class=" fa fa-map-marker" style="font-size: 150%"></i>
                        <div class="px-3 lato">
                            {{$event->location}}
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: none">
                    <label>Location <input id="location" type="textbox" name="location" value="{{$event->location}}"
                                           class="form-control" size="70"></label>
                    @if($errors->has('location'))
                        <span class="help-block alert alert-danger">{{ $errors->first('location') }}</span>
                    @endif

                    <input id="submit" type="button" value="Show on map" class="btn btn-dark">
                </div>
                <div id="map" class="w-100 card-footer"></div>

            </div>

        </div>
    </div>
@endsection