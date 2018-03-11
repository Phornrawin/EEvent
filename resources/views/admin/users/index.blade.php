@extends('layouts.app')
 
@section('content')
 	<style type="text/css">
		
		/* Style the tab content */
		.table{
		    padding: 0px 12px;
		    border: 1px solid #ccc;
		    width: 80%;  
		}
		hr {
		    height: 1px;
		    color:#1C2833;
		    background:#1C2833;
		    font-size: 0;
		    border: 0;
			}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>

    <div class="content">
    	<div class="row">
    		
    			<div class="col-md-2">
    				<h3 align="center">Manage EEvent</h3>
    				<hr>
    				<div class="vertical-menu">
    					<ul>
    						<li><h5><span href="" onclick="onClickUser()" id="defaultOpen">Users</span></h4></li>
    						<hr>
							<li><h5><span href="" onclick="onClickEvent()">Events</span></h4></li>
    					</ul>
					</div>
    			</div>

    			<div class="col-md-10" align="center">
    				 <div id="users" class="content">
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
				                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$user->id}}').submit();">delete</a></td>
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
    				<div id="events" class="content">
				        <table class="table">
				            <tr class="table table-dark" style="width: 80%">
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
				                    <td><a href="{{action('Admin\EventController@edit', ['id' => $event->id])}}">edit</a></td>
				                    <td><a href="#" onclick="event.preventDefault(); document.getElementById('delete-{{$event->id}}').submit();">delete</a></td>
				                </tr>
				                <form id="delete-{{$event->id}}"
				                      action="{{action('Admin\EventController@destroy', ['id' => $event->id])}}" method="POST"
				                      style="display: none;">
				                    @csrf
				                    @method('DELETE')
				                </form>
				            @endforeach
				        </table>
				    </div>
    			</div>
    		
    	</div>
    </div>
    
@endsection