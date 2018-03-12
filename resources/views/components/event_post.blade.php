<div class="card flex-md-row mb-4 box-shadow  boxed-shadow">
    <div class="card-body d-flex flex-column">
        <strong class="d-inline-block mb-2 text-danger">{{$event->category->name}}</strong>
        <h3 class="mb-0 text-dark text-truncate"><p>{{$event->name}}</p></h3>
        <div class="my-1 text-muted card-subtitle">
            @if($event->getRemainingDay() <= 7)
                {{$event->getRemainingDay() . ' days until begin'}}
            @else
                {{$event->getFormattedDay()}}
            @endif</div>
        <p class="card-text mb-auto text-ellipsis-twoline">{{$event->detail}}</p>
        <div class="d-flex mt-4 justify-content-between">
            <div class="d-flex">
                <img class="rounded-circle mr-4" style="width: 50px; height: 50px" src="/uploads/avatars/{{$event->organizer->avatar}}">
                <div class="py-2">
                    <small class="text-muted row"
                           style="font-family: Lato,sans-serif">Hosted by {{$event->organizer->name}}
                    </small>
                    <small class="text-muted row"
                           style="font-family: Lato,sans-serif">{{$event->getRemainingSeat()}} seats left
                    </small>
                </div>
            </div>

            <a href="{{route('events.show', ['id' => $event->id])}}"
               class="btn btn-sm btn-outline-primary align-self-end my-2">
                View
            </a>
        </div>



    </div>

</div>
