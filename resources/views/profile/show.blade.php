@extends('layouts.master')

@section('title', 'Profile | '. Auth::user()->name)

@section('content')
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="uploads/avatars/{{$user->avatar }}" class="img-fluid rounded-circle" alt=""
                             style="max-width: 150px; max-height: 150px">
                    </div>
                    <form enctype="multipart/form-data" action="{{route('profile')}}" method="POST">
                        @csrf
                        <label> Update Profile Image</label>
                        <input type="file" name="avatar" accept=".jpg, .png">
                        <button type="submit">ok</button>
                    </form>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div>
                        <div class="">
                            {{$user->name}}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <a type="button" href="{{route('profile')}}" class="btn btn-success btn-sm">Profile</a>
                        <a type="button" href="{{route('events.index')}}" class="btn btn-danger btn-sm">Events</a>

                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="">
                        <ul class="nav flex-column">
                            <li class="">
                                <a href="#">Overview </a>
                            </li>
                            <li class="">
                                <a href="#">Account Settings </a>
                            </li>
                            <li class="">
                                <a href={{route('logout')}}>Logout </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9">
                <h3>Joined Event</h3>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>view</th>
                    </tr>
                    @foreach(Auth::user()->attendEvent as $event)
                        <tr>
                            <td>{{$event->name}}</td>
                            <td>{{$event->location}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('events.show', ['id' => $event->id])}}">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection