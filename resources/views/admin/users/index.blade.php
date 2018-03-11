@extends('layouts.app')
 
@section('content')
 	<style type="text/css">
      .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
           font-size: 17px;
            width: 50%;
        }

        .tablink:hover {
            background-color: #777;
        }
    </style>
	    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    <button class="tablink" onclick="openPage('users', this, '#17202A')" id="defaultOpen">Users</button>
    <button class="tablink" onclick="openPage('events', this, '#34495E')">Event</button>
    <div id="users" class="tabcontent">
        <table class="table">
            <tr class="table table-dark">
                <th>name</th>
                <th>email</th>
                <th>avatar</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            @foreach($users as $user)
                
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->avatar}}</td>
                    <td><a href="{{action('Admin\UserController@edit', ['id' => $user->id])}}">edit</a></td>
                    <p id="demo"></p>
                    <td><a href="#" onclick="myFunction()">delete</a></td>
	               </tr>
                <form id="delete-{{$user->id}}"
			        action="{{action('Admin\UserController@destroy', ['id' => $user->id])}}" method="POST"
			        style="display: none;">
			        @csrf
			        @method('DELETE')
			    </form>
            @endforeach
        </table>
    </div>
    <div id="events" class="tabcontent">
        <table class="table">
            <tr class="table table-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
                <th>Precondition</th>
                <th>Location</th>
                <th>Code</th>
                <th>Category</th>
                <th>Price</th>
                <th>Payment_time</th>
                <th>Start_time</th>
                <th>Cur_capacity</th>
                <th>Max_capacity</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
            @foreach($events as $event)
                <tr>
                    <td>{{$event->id}}</td>
                    <td>{{$event->name}}</td>
                    <td>{{$event->detail}}</td>
                    <td>{{$event->precondition}}</td>
                    <td>{{$event->location}}</td>
                    <td>{{$event->code}}</td>
                    <td>{{$event->category}}</td>
                    <td>{{$event->price}}</td>
                    <td>{{$event->payment_time}}</td>
                    <td>{{$event->start_time}}</td>
                    <td>{{$event->cur_capacity}}</td>
                    <td>{{$event->max_capacity}}</td>
                    <td>{{$event->created_at}}</td>
                    <td>{{$event->updated_at}}</td>
                    <td><a href="">edit</a></td>
                    <td><a href="">delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection