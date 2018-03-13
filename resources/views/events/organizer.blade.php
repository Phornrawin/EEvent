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
            <div class=" jumbotron p-3 p-md-5 text-white rounded bg-danger">
                <div class="row px-3 justify-content-between">
                    <div class="col-md-6 px-0">
                        <h2><span class="badge badge-info badge-pill display-4">{{$event->category->name}}</span></h2>
                        <h1 class="display-5 font-weight-bold">{{$event->name}}</h1>
                        <div class="d-flex my-4">
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
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{route('events.edit', ['id'=>$event->id])}}"
                                   class="btn btn-warning w-100 font-weight-bold text-muted">
                                    EDIT </a>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-4 px-0">
                        <div class="card ">
                            <div class="card-header">
                                <img class="card-img" src="{{$code}}">
                            </div>
                            <div class="card-body text-dark lato text-center" style="font-size: 150%">
                                <div class="card-title">
                                    {{$event->code}}
                                </div>
                                <small class="card-subtitle">Show this your attendees to let them check in</small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container d-flex justify-content-between py-5">
        <div class="col-md-8">
            <div class="d-flex align-items-center py-4 px-3 text-white bg-haiku rounded box-shadow">
                <div class="">
                    <h4 class="mb-0 lh-100">Request to join </h4>
                    <small>These people ask to be part of your meetup</small>
                </div>
                <p class="text-right">haha</p>
            </div>

            @foreach($requested as $attendee)
                <div class="media d-flex text-muted p-3 my-3 bg-white">
                    <img src="/uploads/avatars/{{$attendee->user->avatar}}" alt="color" class="mr-2"
                         style="width: 50px; height: 50px; border-radius: 50%">
                    <p class="media-body pb-3 mb-0 lh-125 text-truncate">
                        <strong class="d-block text-gray-dark">{{$attendee->user->name}}</strong>
                        <i class="d-block text-gray-dark lato">{{$attendee->user->email}}</i>
                    </p>
                    <div class="col-md-3">
                        <div class="row">
                            <a class="col btn btn-outline-danger mx-1"
                               href="{{route('attendee.accept', ['id' => $attendee->id, 'accepted' => false])}}">
                                Reject
                            </a>
                            <a class="col btn btn-primary mx-1"
                               href="{{route('attendee.accept', ['id' => $attendee->id, 'accepted' => true])}}">
                                Invite
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

            <div class="d-flex align-items-center mt-5 py-4 px-3 text-white bg-firewatch rounded box-shadow">
                <div class="">
                    <h4 class="mb-0 lh-100">Request to join </h4>
                    <small>These people ask to be part of your meetup</small>
                </div>
                <p class="text-right">haha</p>
            </div>

            @foreach($accepted as $attendee)
                <div class="media d-flex text-muted p-3 my-3 bg-white">
                    <img src="/uploads/avatars/{{$attendee->user->avatar}}" alt="color" class="mr-2"
                         style="width: 50px; height: 50px; border-radius: 50%">
                    <p class="media-body pb-3 mb-0 lh-125 text-truncate">
                        <strong class="d-block text-gray-dark">{{$attendee->user->name}}</strong>
                        <i class="d-block text-gray-dark lato">{{$attendee->user->email}}</i>
                    </p>
                    <div class="col-md-3">
                        <div class="row">
                            <a class="col btn btn-outline-danger mx-1"
                               href="{{route('attendee.accept', ['id' => $attendee->id, 'accepted' => false])}}">
                                Reject
                            </a>
                            <a class="col btn btn-primary mx-1"
                               href="{{route('attendee.accept', ['id' => $attendee->id, 'accepted' => true])}}">
                                Invite
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

            <hr>
            <h4 class="ml-3 mt-3">List of check-in</h4>
            <div class="d-flex mt-3">
                @foreach($checkin as $attendee)
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