<div class="col-md-4">

    <div class="card mb-4 position-relative card-rounded box-shadow">

        <img class="card-img-top vignette"
             src="/uploads/events_pic/{{$event->getPicture()}}"
             alt="Card image cap" style="height: 225px; width: 100%; display: block;">

        <img class="rounded-circle position-absolute" style="width: 50px; height: 50px; top: 10px; left: 10px"
             src="/uploads/avatars/{{$event->organizer->avatar}}">
        <div class="card-body">

            <h5 class="card-title text-truncate">{{$event->name}}</h5>

            <p class="card-subtitle text-secondary">
                @if($event->getRemainingDay() <= 7)
                    {{$event->getRemainingDay() . ' days until begin'}}
                @else
                    {{$event->getFormattedDay()}}
                @endif
            </p>
            <p class="card-text text-ellipsis-twoline">{{$event->detail}}</p>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="btn-group">
                    <a href="{{route('events.show', ['id' => $event->id])}}"
                       class="btn btn-sm btn-outline-primary">
                        View
                    </a>
                    @if($event->isAttend(Auth::id()) or $event->isOrganizer(Auth::id()))
                        <a class="btn btn-sm btn-outline-secondary disabled">
                            Joined
                        </a>
                    @elseif($event->getRemainingSeat() <= 0)
                        <a class="btn btn-sm btn-outline-secondary disabled">
                            Full
                        </a>
                    @else
                        <a class="btn btn-sm btn-outline-danger" onclick="event.preventDefault();
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
                <div class="pr-2">
                    <small class="text-muted row"
                           style="font-family: Lato,sans-serif">Hosted by {{$event->organizer->name}}
                    </small>
                    <small class="text-muted row justify-content-end"
                           style="font-family: Lato,sans-serif">{{$event->getRemainingSeat()}} seats left
                    </small>
                </div>

            </div>

        </div>
    </div>
</div>