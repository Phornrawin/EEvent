@extends('layouts.master')

@section('title', 'Events - EEvent')
@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="font-weight-light">
                All Events
            </h1>
            <p class="lead text-muted">
                "There are two types of people who will tell you that you cannot make a difference in this world: those
                who are afraid to try and those who are afraid you will succeed."
            </p>
        </div>
    </section>
    @include('layouts.cards')
    <div class="d-flex justify-content-center">
        {{$events->links()}}
    </div>
@endsection