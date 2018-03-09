<div class="container py-4">
    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card mb-4" style="box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05)">
                    <img class="card-img-top" src="https://www.hsjaa.com/images/joomlart/demo/default.jpg"
                         alt="Card image cap" style="height: 225px; width: 100%; display: block;">
                    <div class="card-body">
                        <h5 class="card-title">{{$event->name}}</h5>
                        <p class="card-subtitle text-secondary">
                            @if($event->getRemainingDay() <= 7)
                                {{$event->getRemainingDay() . ' days until begin'}}
                            @else
                                {{$event->getFormattedDay()}}
                            @endif
                        </p>
                        <p class="card-text">{{$event->detail}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('events.show', ['id' => $event->id])}}"
                                   class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                                @if($event->isAttend(Auth::id()) or $event->isOrganizer(Auth::id()))
                                    <a class="btn btn-sm btn-outline-secondary disabled">
                                        Joined
                                    </a>
                                @else
                                    <a class="btn  btn-sm btn-outline-danger" onclick="event.preventDefault();
                                            document.getElementById('attend-form-{{$event->id}}').submit();">
                                        Join
                                    </a>

                                    <form id="attend-form-{{$event->id}}"
                                          action="{{route('events.attend', ['id' => $event->id])}}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                            <small class="text-muted"
                                   style="font-family: Lato,sans-serif">{{$event->getRemainingSeat()}} seats left
                            </small>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>