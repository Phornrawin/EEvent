@extends('layouts.master')

@section('title', Auth::user()->name . '- EEvent')

@section('content')
    <div class="container">
        <div class="row position-relative">
            <div class="col-md-3 my-5">
                @include('components.profile_card')
            </div>
            <div class="col-md-9 my-5">
                <div class="d-flex align-items-center py-4 px-3 text-white bg-sunset rounded box-shadow">
                    <div class="">
                        <h6 class="mb-0 lh-100">Joined Event</h6>
                        <small>You are going there</small>
                    </div>
                </div>
                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Upcoming</h6>
                    @if(Auth::user()->attendEvent->isEmpty())
                        <div class="pt-3 text-muted">No events coming, why not look for one</div>
                    @endif
                    @foreach(Auth::user()->attendEvent as $event)
                        <div class="media text-muted pt-3">
                            <div alt="color" class="mr-2 rounded"
                                 style="width: 32px; height: 32px; background-color: {{'#'. bin2hex(openssl_random_pseudo_bytes(3))}}"
                                 data-holder-rendered="true"></div>
                            <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <strong class="d-block text-gray-dark">{{$event->name}}</strong>
                                <i class="d-block text-gray-dark">{{$event->start_time}}</i>
                                {{$event->detail}}
                            </p>
                            <a class="btn btn-primary" href="{{route('events.show', ['id' => $event->id])}}">
                                View
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex align-items-center py-4 px-3 text-white bg-aqua rounded box-shadow">
                    <div class="">
                        <h6 class="mb-0 lh-100">Hosted Event</h6>
                        <small>You are hosting these events.</small>
                    </div>
                </div>

                <div class="my-3 p-3 bg-white rounded box-shadow">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Upcoming</h6>
                    @if(Auth::user()->organizedEvent->isEmpty())
                        <div class="pt-3 text-muted">No events coming, why not try create one</div>
                    @endif
                    @foreach(Auth::user()->organizedEvent as $event)
                        <div class="media text-muted pt-3">
                            <div alt="color" class="mr-2 rounded"
                                 style="width: 32px; height: 32px; background-color: {{$event->category->color}}"
                                 data-holder-rendered="true"></div>
                            <p class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                                <strong class="d-block text-gray-dark">{{$event->name}}</strong>
                                <i class="d-block text-gray-dark">{{$event->start_time}}</i>
                                {{$event->detail}}                            </p>
                            <div class="row">
                                <a class="col btn btn-outline-warning mx-1"
                                   href="{{route('events.edit', ['id' => $event->id])}}">
                                    Edit
                                </a>
                                <a class="col btn btn-primary mx-1"
                                   href="{{route('events.show', ['id' => $event->id])}}">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('components.event_search')
@endsection