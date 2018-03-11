<div id="event_carousel" class="carousel slide w-100" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($events); $i++)
            <li data-target="#event_carousel" data-slide-to="{{$i}}"
                class="{{$i == 0 ? 'active' : ''}}"></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @for($i = 0; $i < count($events); $i++)

            <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                <div class="mx-auto" style="width: auto; height: 400px; overflow: hidden ">
                    <img class="d-block w-100"
                         src="uploads/events_pic/{{$events[$i]->path ==null ?$events[$i]->getDefaultPicture() : $events[$i]->image_path}}"
                         alt="{{$events[$i]->name}}" style="width: auto; height: auto;">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$events[$i]->name}}</h5>
                    <p>{{$events[$i]->organizer->name}}</p>
                </div>
            </div>
        @endfor
    </div>
    <a class="carousel-control-prev" href="#event_carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#event_carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>