@extends('layouts.master')

@section('title', 'EEvent - The place to looks for awesome events')

@section('content')
    {{-----Focal Points Zone-----}}
    <div class="d-flex flex-column text-center justify-content-center pb-xl-5 background"
         style="height: 100vh;">
        <div>
            <h1 class="logo display-2">EEvent</h1>
            <h2 class="font-weight-light mt-3">[ Where Everywhere meets Event ]</h2>
            <div>
                <a class="btn btn-lg btn-danger mt-4" href={{route('events.index')}}>Explore</a>
            </div>
        </div>
    </div>

    {{-----Search Events Zones-----}}
    <div class="text-center w-100 bg-secondary mb-4 py-3">
        <form method="get" action="{{route('events.search')}}">
            <div class="form-row align-items-center justify-content-center">
                <div class="col-sm-3 my-1">
                    <div class="input-group">
                        <input type="text" class="form-control" id=""
                               placeholder="search events" name="q">
                        <div class="input-group-append">
                            <button type="submit" class="btn"><i class=" fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-----Popular Events Zones-----}}
    <div class="container py-4">
        <div class="row">
            @foreach($popular as $event)
                @include('components.event_card', ['event' => $event])
            @endforeach
        </div>
    </div>
    {{-----Recent Events Zones-----}}
    <div class="container py-4">
        <h3 class="font-weight-bold mb-3">Newest Events</h3>
        <p>Newest event asking you to joined</p>
        <div class="row">
            @foreach($recent as $event)
                @include('components.event_card', ['event' => $event])
            @endforeach
        </div>
    </div>

    <div class="philosophy-block text-center p-5 container">
        <h3 class="mb-4">Philosophy of Our Team</h3>
        <p>At EEvent, we strive to create a place where everyone can look and become part of the great communities.
            We believe that people, when joined and interacted with each other can bring out their potential to the
            greatest</p>
        <cite>The journey of a thousand miles begins with one step. ~ Lao Tzu</cite>
    </div>
@endsection

