@extends('layouts.master')

@section('title', 'Search - EEvent')

@section('content')
    @if($events->isEmpty())
        <div class="d-flex justify-content-center align-items-center" style="height: 80vh">
            <h2 class="display-5">There is no events with that name. Why not try create one</h2>
        </div>
    @else
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="font-weight-light">
                    Search: {{$query}}
                </h1>
                <p class="lead text-muted">
                    "There are two types of people who will tell you that you cannot make a difference in this world:
                    those
                    who are afraid to try and those who are afraid you will succeed."
                </p>
            </div>
        </section>
        <div class="container py-4">
            <div class="row">
                @foreach($events as $event)
                    @include('components.event_card', ['event' => $event])
                @endforeach
            </div>
        </div>
        @empty($events)
            <div class="d-flex justify-content-center">
                {{$events->links()}}
            </div>
        @endempty
    @endif
@endsection