@extends('layouts.master')

@section('title', 'All Events - EEvent')
@section('content')
    <section class="bg-firewatch jumbotron rounded-0 text-center text-light mb-0">
        <div class="container">
            <h1 class="font-weight-light mb-4">
                Pick your Event
            </h1>
            <p class="lead">
                "There are two types of people who will tell you that you cannot make a difference in this world: those
                who are afraid to try and those who are afraid you will succeed."
            </p>
        </div>
    </section>
    @include('components.event_search')

    @if($events->isEmpty())
        <div class="d-flex flex-column justify-content-center align-items-center" style="height: 50vh">
            <h2 class="display-5 font-weight-light">We can't find your event. Why not try create one ?</h2>
            <a class="btn btn-danger my-3" href="/events/create">Create an Event</a>
        </div>
    @else
        <div class="container py-4">
            <div class="row">
                @foreach($events as $event)
                    @include('components.event_card', ['event' => $event])
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{$events->links()}}
        </div>
    @endif
@endsection