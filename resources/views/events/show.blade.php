@extends('layouts.master')

@section('content')
    <div>
        @if ($errors->any())
            <div class="alert-danger" data-toggle="modal">{{$errors}}</div>
        @endif

        <div class="imageHeader">
            <img class="img-fluid" src="/uploads/events_pic/{{$event->image_path}}" style="border-radius: 20px 20px 0px 0px">
        </div>
        <div class="summaryDetail">
            <div class="">
                <p style="font-size: 25px">{{$event->name}}</p>
                <li>date : {{$event->start_time}}</li>
                <li>location : {{$event->location}}</li>
                <li>Organizer : {{$event->organizer->name}}</li>
            </div>
            <div class="">
                Tag : {{$event->category->name}} <br>
                Price : <b style="color: red">{{$event->getPriceText()}}</b>
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
            <button class="tablinks" onclick="openTab(event, 'Detail')" id="default-click">Detail</button>
            <button class="tablinks" onclick="openTab(event, 'Paid')">Paid</button>
            <button class="tablinks" onclick="openTab(event, 'Booked')">Booked</button>
        </div>

        <div id="Detail" class="tabcontent scrollbar-primary">
            {{$event->detail}}
            <div class="force-overflow"></div>
        </div>

        <div id="Paid" class="tabcontent scrollbar-primary">
            <?php $count = 0;?>
            <table class="table">
                    @foreach($event->attendees as $attendee)
                            @if($attendee->payment != null and $attendee->payment->status == "paid")
                                <?php ++$count; ?>
                                @if($count <= 1)
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Payment Status</th>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{$attendee->user->name}}</td>
                                    <td>{{$attendee->user->email}}</td>
                                    <td>{{$attendee->payment->status}}</td>
                                </tr>
                            @endif
                    @endforeach
                @if($count == 0)
                    <p>No member</p>
                @endif
            </table>
            <div class="force-overflow"></div>
        </div>

        <div id="Booked" class="tabcontent scrollbar-primary">
            <?php $count = 0; ?>
            <table class="table">
                @foreach($event->attendees as $attendee)
                    @if($attendee->payment != null and $attendee->payment->status == "unpaid")
                        <?php ++$count; ?>
                        @if($count <= 1)
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Payment Status</th>
                            </tr>
                        @endif
                        <tr>
                            <td>{{$attendee->user->name}}</td>
                            <td>{{$attendee->user->email}}</td>
                            <td>{{$attendee->payment->status}}</td>
                        </tr>
                    @endif
                @endforeach
                    @if($count == 0)
                        <p>No member</p>
                    @endif
            </table>
            <div class="force-overflow"></div>
        </div>

        <div>
            Attendee:
            @foreach($event->attendees as $attendee)
                <div>{{$attendee->user->name}}</div>
                <div>{{$attendee->user->email}}</div>
                @if($attendee->payment != null)
                    <div>{{$attendee->payment->status}}</div>
                    <br>
                @endif
            @endforeach
        </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        document.getElementById("default-click").click();
    </script>
@endsection
