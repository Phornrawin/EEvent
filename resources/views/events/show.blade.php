@extends('layouts.master')

@section('content')
    <div>
        <div class="imageHeader">image</div>
        <div class="summaryDetail">
            <div class="">
                <p style="font-size: 25px">{{$event->name}}</p>
                <li>date : {{$event->start_time. ' to ' . $event->end_time}}</li>
                <li>location : {{$event->location}}</li>
                <li>Organizer : {{$event->organizer->user->name}}</li>
            </div>
            <div class="">
                Tag : {{$event->category}} <br>
                @if ($event->price == 0)
                    Price : <b style="color: red">free</b>
                @else
                    Price : <b>{{$event->price}}</b>
                @endif
                <br>
                Members : <b>{{$event->cur_capacity .' / ' .$event->max_capacity}}</b> <br>

                @if(!$event->isAttend(Auth::id()))
                    <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                        @csrf
                        <button class="btn btn-primary" type="submit">I'm going</button>
                    </form>
                @else
                    <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                        @csrf
                        <button class="btn btn-danger" type="submit">I'cant go anymore</button>
                    </form>
                @endif
            </div>

        </div>

        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Detail')" id="default-click">Detail</button>
            <button class="tablinks" onclick="openCity(event, 'Paid')">Paid</button>
            <button class="tablinks" onclick="openCity(event, 'Booked')">Booked</button>
        </div>

        <div id="Detail" class="tabcontent scrollbar-primary">
            {{$event->detail}}
            <div class="force-overflow"></div>
        </div>

        <div id="Paid" class="tabcontent scrollbar-primary">

            <div class="force-overflow"></div>
        </div>

        <div id="Booked" class="tabcontent scrollbar-primary">

            <div class="force-overflow"></div>
        </div>

        <div>


            Attendee:
            @foreach($event->attendees as $attendee)
                <div>User: {{$attendee->user->name}}</div>
                <div>Email: {{$attendee->user->email}}</div>
                @if($attendee->payment != null)
                    <div>Payment: {{$attendee->payment->payment_time}}</div>
                    <br>
                @endif
            @endforeach
        </div>

        @if(!$event->isAttend(Auth::id()))
            <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                @csrf
                <button class="btn btn-primary" type="submit">I'm going</button>
            </form>
        @else
            <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                @csrf
                <button class="btn btn-danger" type="submit">I'cant go anymore</button>
            </form>
        @endif
    </div>

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("default-click").click();
    </script>
@endsection
