@extends('layouts.master')

@section('content')
    @if ($errors->any())
        <script>swal('{{$errors}}')</script>
    @endif

    @if (session('success'))
        <script>swal("Success!", "{{session('success')}}", "success");</script>
    @endif


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
                            {{--<img class="card-img-top vignette"--}}
                            {{--src="/uploads/events_pic/{{$event->getPicture()}}"--}}
                            {{--alt="Card image cap" style="height: 225px; width: 100%; display: block;">--}}
                            <div class="card-header">
                                <h4 class="card-subtitle py-3 text-muted font-weight-light"><span
                                            class="badge badge-danger py-1 mx-2">{{$event->getPriceText()}}</span></h4>
                                <div class="row px-3 align-items-center justify-content-between">
                                    <h2 class="text-dark font-weight-bold mx-2 ">Are you going ? </h2>
                                    <span class="text-muted mr-2">{{$event->cur_capacity}} people going</span>
                                </div>

                            </div>
                            <div class="card-footer">
                                {{--edit button for organizer--}}
                                @if(Auth::user()!= null and Auth::user()->id == $event->organizer_id)
                                    <a href="{{route('events.edit', ['id'=>$event->id])}}"
                                       class="btn btn-warning w-100 font-weight-bold text-muted">
                                        EDIT </a>
                                @elseif(!$event->isAttend(Auth::id()))
                                    <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                                        @csrf
                                        <button class="btn btn-info w-100 font-weight-bold">X</button>
                                    </form>
                                @else
                                    <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                                        @csrf
                                        <button class="btn btn-danger w-100 font-weight-bold"><i
                                                    class="fa fa-times"></i></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container py-5">
        <div class="col-md-6">
            <img class="img-fluid py-3" src="/uploads/events_pic/{{$event->getPicture()}}">
            <hr>
            <div class="py-3">
                <h4>- What it is about</h4>
                <p>{{$event->detail}}</p>
            </div>
            <div class="py-3">
                <h4>- What it is about</h4>
                <p>{{$event->precondition}}</p>
            </div>
        </div>
    </div>
@endsection