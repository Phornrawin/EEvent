@extends('layouts.master')

@section('title', 'EEvent - The place to looks for awesome events')

@section('content')
    {{-----Focal Points Zone-----}}
    <div class="d-flex flex-column text-center justify-content-center pb-xl-5 background"
         style="height: 100vh;">
        <div>
            <h1 class="logo display-2 text-light">EEvent</h1>
            <h2 class="font-weight-light mt-3 text-light">[ Where Everywhere meets Event ]</h2>
            <div>
                <a class="btn btn-lg btn-outline-light mt-4" href={{route('events.index')}}>Explore</a>
            </div>
        </div>
    </div>

    {{-----Search Events Zones-----}}
    @include('components.event_search')

    <nav class="stripe row justify-content-center flex-nowrap py-4">
        <button type="button" class="btn btn-danger rounded mx-2">Join a movement</button>
        <button type="button" class="btn btn-danger rounded mx-2">Learn to cook</button>
        <button type="button" class="btn btn-danger rounded mx-2">Dance your move</button>
        <button type="button" class="btn btn-danger rounded mx-2">Watch a film</button>
        <button type="button" class="btn btn-danger rounded mx-2">Become an adventurer</button>
    </nav>

    {{-----Popular Events Zones-----}}
    <section class="container py-4">
        <h3 class="font-weight-bold mb-3">What people hype about</h3>
        <div class="row">
            @foreach($popular as $event)
                @include('components.event_card', ['event' => $event])
            @endforeach
        </div>
    </section>

    {{-----Recent Events Zones-----}}
    <section class="container py-5">
        <h3 class="font-weight-bold mb-3">Newest Events</h3>
        <div class="row mb2">
            @foreach($recent as $event)
                <div class="col-md">
                    @include('components.event_post', ['event' => $event])
                </div>
            @endforeach
        </div>

    </section>

    <section class="philosophy-block text-center p-5 container">
        <h3 class="mb-4">Our vision</h3>
        <p>At EEvent, we strive to create a place where everyone can look and become part of the great communities.
            We believe that people when joined and interacted with each other can bring out their potential to the
            fullest.</p>
        <cite>The journey of a thousand miles begins with one step. ~ Lao Tzu</cite>
    </section>
@endsection

