@extends('layouts.master')

@section('title', 'EEvent - The place to looks for awesome events')

@section('content')
    <div class="d-flex flex-column text-center justify-content-center pb-xl-5 background"
         style="height: 100vh;">
        <div>
            <h1 class="display-2">EEvent</h1>
            <p>[ Where Everything meets Everywhere ]</p>
            <div>
                <a class="btn btn-danger m-2" href={{route('events.index')}}>Explore</a>
            </div>
        </div>
    </div>

    <div class="text-center w-100 bg-secondary mb-4 py-3">
        <form method="get" action="{{route('events.search')}}">
            <div class="form-row align-items-center justify-content-center">
                <div class="col-sm-3 my-1">
                    <div class="input-group">
                        <input type="text" class="form-control" id=""
                               placeholder="search events" name="q">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text"><i class=" fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('layouts.cards', ['events' => $recent])

@endsection

