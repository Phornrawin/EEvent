@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <img src="uploads/avatars/{{$user->avatar }}"
                     style="width: 150px; height: 150px; float: left; border-radius: 50%;margin-right: 20px">

                <h2>Hi! {{$user->name}}</h2>
                <h3>Email: {{$user->email}}</h3>
                <form enctype="multipart/form-data" action="{{route('profile')}}" method="POST">
                    <label> Update Profile Image</label>
                    <input type="file" name="avatar" accept=".jpg, .png">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit">ok</button>
                </form>
                <br><br><br>
                @if(!$user->attendEvent->isEmpty())
                    <h3>Event ที่เคยเข้าร่วม</h3>
                    <table style="width:100% ; border: 4px solid #34ce57">
                        <tr style="width:100% ; border: 1px solid #34ce57">
                            <th>Name</th>
                            <th>Location</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        <tr>
                            <td>@foreach($user->attendEvent as $role)
                                    <div><a href="#" >{{$role->name}}</a></div>
                                @endforeach
                            </td>
                            <td>@foreach($user->attendEvent as $role)
                                    <div>{{$role->location}}</div>
                                @endforeach</td>
                            <td>@foreach($user->attendEvent as $role)
                                    <div>{{$role->start_time}}</div>
                                @endforeach</td>
                            <td>@foreach($user->attendEvent as $role)
                                    <div>{{$role->end_time}}</div>
                                @endforeach</td>
                        </tr>

                    </table>
                @elseif(!$user->organizedEvent->isEmpty())
                    <h3>Event ที่จัด</h3>

                    <table style="width:100% ; border: 4px solid #34ce57">
                        <tr style="width:100% ; border: 1px solid #34ce57">
                            <th>Name</th>
                            <th>Location</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                        <tr>
                            <td>@foreach($user->organizedEvent as $role)
                                    <div><a href="#" >{{$role->name}}</a></div>
                                @endforeach
                            </td>
                            <td>@foreach($user->organizedEvent as $role)
                                    <div>{{$role->location}}</div>
                                @endforeach</td>
                            <td>@foreach($user->organizedEvent as $role)
                                    <div>{{$role->start_time}}</div>
                                @endforeach</td>
                            <td>@foreach($user->organizedEvent as $role)
                                    <div>{{$role->end_time}}</div>
                                @endforeach</td>
                        </tr>

                    </table>
                @endif



            </div>
        </div>
    </div>
@endsection