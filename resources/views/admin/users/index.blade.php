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
	                <td><a href="">edit</a></td>
	                <td><a href="">delete</a></td>
	            </tr>
	        @endforeach
	    </table>
	</div>
	<div id="events" class="tabcontent">
	    
	</div>



@endsection