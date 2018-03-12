@extends('layouts.master')

@section('content')

    <style>
        body {
            background: linear-gradient(#FFEDED, #BC8F8F);
        }

        .summaryDetail {
            background: #343a40;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0px;
            margin-bottom: 50px;
            text-align: left;
            padding: 90px 200px;
            width: auto;
            height: auto;

        }

        .imageHeader {
            width: 800px;
            height: auto;
            margin-top: 50px;
            margin-left: auto;
            margin-right: auto;
        }

        .detail {
            background: white;
            height: auto;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            padding: 50px 100px;
            margin-bottom: 50px;
        }

        button {
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
            border-radius: 10px;
        }

        .scrollbar-primary::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-primary::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #2D3C49;
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
            color: white;
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
            padding: 50px;
            border-top: none;
            height: 500px;
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            overflow: scroll;
            margin-bottom: 100px;
        }

        .editBtn {
            margin: 10px;
            padding: 20px;
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            cursor: pointer; /* Add a mouse pointer on hover */
            background: firebrick;
            border-radius: 50%;
            height: 120px;
            width: 120px;
            color: white;
            box-shadow: 0 .25rem .35rem rgba(0, 0, 0,0.2);
        }

        .editBtn:hover {
            background-color: #494E53;
            box-shadow: 0 .25rem .35rem rgba(0, 0, 0,0.5);
            transform: scale(1.15);
        }

        .commentBox {
            text-align: left;
            color: white;
            height: auto;
            width: 800px;
            padding-top: 50px;
            /*margin-top: 50px;*/
            margin-left: auto;
            margin-right: auto;
        }

        .comment-textinput {
            border: 1px solid rgba(1, 1, 1, 0.3);
            width: 100%;
            padding: 4px 7px;
            margin-top: 5px;
            font-size: 13px;
            line-height: 24px;
            resize: none;
            transition: ease 0.2s;
            outline: none !important;
        }
        .chip {
            display: inline-block;
            padding: 0 25px;
            height: 40px;
            line-height: 40px;
            border-radius: 25px;
            background-color: firebrick;
        }

        .chip img {
            float: left;
            margin: -5px 10px 5px -25px;
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }

        .js {background-color: firebrick;} /* Red */

        .progressbar {
            width: 100%; /* Full width */
            background-color: #ddd; /* Grey background */
            border-radius: 5px;
        }

        .skills {
            text-align: right; /* Right-align text */
            padding-right: 20px; /* Add some right padding */
            line-height: 30px; /* Set the line-height to center the text inside the skill bar, and to expand the height of the container */
            color: white; /* White text color */
            border-radius: 5px 0px 0px 5px;
        }

        .user-comment img ::after{
            content: "";
            clear: both;
            display: table;
        }
        .btn{
            border-radius: 25px;
            background: firebrick;
            color: white;
            box-shadow: 0.15rem .25rem rgba(0, 0, 0,0.2);
            cursor: pointer;
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none;
        }

        .cannotBtn:hover{background-color: #910A0A;}

        .goingBtn:hover{background-color: #003872;}
        .goingBtn{background: #005cbf;}

        .btn:hover {
            box-shadow: 0.15rem .25rem rgba(0, 0, 0,0.5);
            transform: scale(1.15);
        }
        .comment-text{

            margin-left: 50px;
            margin-right: 50px;
            /*background: black;*/
            padding: 30px 50px;
            padding-bottom: 10px;
            border-bottom: white;
            border-bottom-style: solid;
            border-bottom-width: 1px;
        }


    </style>

    <div>
        @if ($errors->any())
            <script>swal('{{$errors}}')</script>
        @endif

        @if (session('success'))
            <script>swal("Success!", "{{session('success')}}", "success");</script>
        @endif


        <div class="summaryDetail">

            <div class="">
                <h1 style="font-size: 40px">{{$event->name}}</h1>
                <div class="chip">
                    <img class="" width="96" height="96" src="/uploads/avatars/{{$event->organizer->avatar}}">
                    {{$event->organizer->name}}
                </div><br><div style="font-size: 13px"><i class="fa fa-phone" style="padding-left: 50px"></i> contact</div>
                <div style="font-size: 20px"><b style="color: firebrick">{{$event->getRemainingDay()}}</b> days until begin</div>
                <div style="background: firebrick; border-radius: 50%;height: 110px;width: 110px;text-align: center; padding: 33px 26px; font-size: 25px; top: 170px; position: absolute;left: 50px;line-height: 16px">
                    <b style="font-size: 15px">Price<br></b>
                    {{$event->getPriceText()}}
                </div>
                <br>
            </div>
            <div class="" style="">
                <b style="font-size: 20px;text-align: center; line-height: 0px">visitor {{$event->cur_capacity .' / ' .$event->max_capacity}}</b>
                <br>


                <div class="progressbar">
                    <div class="skills js" style="width: {{($event->cur_capacity/$event->max_capacity*100)."%"}};"> {{($event->cur_capacity/$event->max_capacity*100)}}%</div>
                </div>
                <br>
                @if(!$event->isAttend(Auth::id()))
                    <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                        @csrf
                        <button class="btn goingBtn" type="submit">I'm going</button>
                    </form>
                @else
                    <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                        @csrf
                        <button class="btn cannotBtn" type="submit">I'cant go anymore</button>
                    </form>
                @endif
            </div>

        </div>


        <div class="imageHeader">
            <img class="img-fluid" src="/uploads/events_pic/{{$event->getPicture()}}"
                 style="border-radius: 20px 20px 0px 0px">
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

        <div id="Detail" class="tabcontent scrollbar-primary" style="text-align: left;">
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
    @if(Auth::user()!= null and Auth::user()->id == $event->organizer_id)
        <button type="button" class="editBtn" id="editBtn" style="font-size: 30px;">Edit</button>
    @else
        @if(!$event->isAttend(Auth::id()))
            <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                @csrf
                <button class="editBtn" type="submit" id="bookedBtn" style="background: #005cbf; display: none;">I'm
                    going
                </button>
            </form>
        @else
            <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                @csrf
                <button class="editBtn" type="submit" id="bookedBtn" style="display: none;">
                    I'cant go anymore
                </button>
            </form>
        @endif
    @endif

    <div style="background: #343a40; text-align: center">
    <div class="commentBox">
        {{--action="{{route('events.unattend', ['id' => $event->id])}}"--}}
        <h2>Comments</h2>
        <form method="post">
            <textarea class="comment-textinput" name="comment" id="comment"></textarea> <br>
            <input type="submit" class="comment-submit btn goingBtn" value="send message">
        </form>
        <br>

        <p style="padding-top: 30px; padding-left: 50px; border-bottom: 1px solid white">All comments</p>


        <div class="comment-text">

            {{--show text--}}
            <div class="text" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);min-height: 50px"></div>

            {{--show user--}}
            <div class="user-comment" style="display: flex;margin-top: 10px">
                <div style="margin: 0px 10px; flex-grow: 1;">
                <img class="rounded-circle" width="50" height="50" src="/uploads/avatars/{{$event->organizer->avatar}}" style="float: left">
                </div>
                <div style="line-height: 3px; flex-grow: 8;">
                    <h3>name</h3>
                    <small>email</small>
                </div>
                <div class="timestamp" style="align-self: flex-end;font-size: 10px ; flex-grow: 8; text-align: right">dd/mm/yyyy hh:mm:ss</div>
            </div>

        </div>

    </div>
    </div>
    <script>
        window.onscroll = function () {
            scrollFunction()
        };

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