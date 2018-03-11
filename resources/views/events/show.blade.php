@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background: linear-gradient(#FFEDED,#BC8F8F);
        }
        .summaryDetail{
            background: #212529;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 50px;
            text-align: left;
            padding: 80px 200px;
        }
        .imageHeader{
            height: 500px;
            width: 800px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 35px;
        }
        .detail{
            background: white;
            height: 200px;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px 100px;
            margin-bottom: 50px;
        }
        button{
            font-size: 16px;
            padding: 15px 30px;
            height: 50px;
            width: 200px;
        }
        .force-overflow {
            min-height: 220px;
        }
        .scrollbar-primary::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px; }

        .scrollbar-primary::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-primary::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #2D3C49;
        }
        .members{
            font-size: 20px;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #5F6D7A;
            background-color: #5F6D7A;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: contour;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #A9AFB5;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #465665;
        }

        /* Style the tab content */
        .tabcontent {
            background: white;
            text-align: center;
            display: none;
            padding: 6px 12px;
            border-top: none;
            height: 500px;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            overflow: scroll;
            box-shadow: 0 .25rem .75rem rgb(95, 109, 122);
            margin-bottom: 100px;
        }
        .bookedBtn{
            display: none;
            margin: 10px;
            padding: 10px;
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            cursor: pointer; /* Add a mouse pointer on hover */
        }
        #bookedBtn:hover {
            background-color: #555; /* Add a dark-grey background on hover */
        }

        .commentBox{
            height: 500px;
            width: 800px;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
        }
        .comment-textinput{
            border:1px solid rgba(1,1,1,0.3);
            width:100%;
            padding:4px 7px;
            margin-top:5px;
            font-size:13px;
            line-height:24px;
            resize:none;
            transition:ease 0.2s;
            outline:none !important;
        }
    </style>

    <div>
        @if ($errors->any())
            <div class="alert-danger" data-toggle="modal">{{$errors}}</div>
        @endif

            <div class="summaryDetail">
                <div class="">
                    <h1 style="font-size: 40px">{{$event->name}}</h1>
                    create by {{$event->organizer->name}} <br>
                    <b style="color: firebrick">{{$event->getRemainingDay()}}</b> days until begin <br>
                    <i class="fa fa-dollar"></i> <b style="color: red">{{$event->getPriceText()}}</b>
                    <br>
                </div>
                <div class="" style="text-align: center;">
                    visitor<br> <b style="font-size: 30px;text-align: center;">{{$event->cur_capacity .' / ' .$event->max_capacity}}</b> <br>

                    @if(!$event->isAttend(Auth::id()))
                        <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                            @csrf
                            <button class="btn btn-primary" type="submit" >I'm going</button>
                        </form>
                    @else
                        <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                            @csrf
                            <button class="btn btn-danger" type="submit">I'cant go anymore</button>
                        </form>
                    @endif
                </div>

            </div>


        <div class="imageHeader">

            <img class="img-fluid" src="/uploads/events_pic/{{$event->image_path}}" height="500px" width="800px" style="border-radius: 20px 20px 0px 0px">
        </div>
            <div class="detail">
                <h1 style="font-size: 40px">{{$event->name}}</h1>
                <i class="fa fa-calendar"></i> {{$event->getFormattedDay()}} <br>
                <i class="fa fa-location-arrow"></i> {{$event->location}} <br>
                <i class="fa fa-tag"></i> {{$event->category->name}} <br>
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
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Status</th>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$attendee->user->name}}</td>
                                    <td>{{$attendee->user->email}}</td>
                                    <td>{{$attendee->payment->status}}</td>
                                </tr>
                            @endif
                    @endforeach
                @if($count == 0)
                    <p style="font-size: 30px;padding-top: 200px;">No visitor</p>
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
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Payment Status</th>
                            </tr>
                        @endif
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$attendee->user->name}}</td>
                            <td>{{$attendee->user->email}}</td>
                            <td>{{$attendee->payment->status}}</td>
                        </tr>
                    @endif
                @endforeach
                    @if($count == 0)
                        <p style="font-size: 30px;padding-top: 200px;">No visitor</p>
                    @endif
            </table>
            <div class="force-overflow"></div>
        </div>
    </div>
            {{--edit button for organizer--}}
            {{--@if(Auth::user()!= null and Auth::user()->id == $event->organizer_id)--}}
                {{--<button type="button" class="bookedBtn btn btn-danger" id="editBtn">Edit</button>--}}
            {{--@endif--}}

    <div class="commentBox">
        {{--action="{{route('events.unattend', ['id' => $event->id])}}"--}}
        Comments
        <form method="post" >
            <textarea class="comment-textinput" name="comment" id="comment"></textarea> <br>
            <input type="submit" class="comment-submit btn btn-primary" value="send message">
        </form>

    </div>


    @if(!$event->isAttend(Auth::id()))
        <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
            @csrf
            <button class="bookedBtn btn btn-primary" type="submit" id="bookedBtn">I'm going</button>
        </form>
    @else
        <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
            @csrf
            <button class="bookedBtn btn btn-danger" type="submit" id="bookedBtn">I'cant go anymore</button>
        </form>
    @endif

    <script>
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("bookedBtn").style.display = "block";
            } else {
                document.getElementById("bookedBtn").style.display = "none";
            }
        }

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
