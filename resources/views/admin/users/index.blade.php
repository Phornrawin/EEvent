@extends('layouts.app')
 
@section('content')
 	<style type="text/css">
		
		/* Style the tab content */
		.table{
		    padding: 0px 12px;
		    border: 1px solid #ccc;
		    width: 80%;  
		}

		/*input{
			margin: 10px;
		}*/

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>

    <div class="content">
    	<div class="row">
    		
    			<div class="col-md-2">
    				<h3 align="center">Manage EEvent</h3>
    				<hr style="height: 2px; color:#1C2833; background:#1C2833;">
    				<div class="vertical-menu">
    					<ul>
    						<li><h5><span href="" onclick="onClickUser()" id="defaultOpen">Users</span></h4></li>
    						<hr>
							<li><h5><span href="" onclick="onClickEvent()">Events</span></h4></li>
							<hr>
							<li><h5><span href="" onclick="onClickCreateUser()">Create user</span></h4></li>
							<hr>
							<li><h5><span href="" onclick="onClickCreateEvent()">Create event</span></h4></li>
    					</ul>
					</div>
    			</div>

    			<div class="col-md-10" align="center" style="width: 100%">
    				 <div id="users" class="content">
    				 	<h3>Users Table</h3>
    				 	<hr style="height: 1px; color:#1C2833; background:#1C2833;">
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
    					<h3>Evants Table</h3>
    					<hr style="height: 2px; color:#1C2833; background:#1C2833;">
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

				    <div id="createUser" class="content">
				    	 <div class="container">
					        <div class="row justify-content-center">

					            <div class="col-md-8">
					            	<h3>Create User</h3>
	            					<hr style="height: 2px; color:#1C2833; background:#1C2833;">
					                <div class="card">
					                    <div class="card-header">Register</div>

					                    <div class="card-body">
					                        <form method="POST" action="{{ route('admin.users.store') }}">
					                            @csrf

					                            <div class="form-group row">
					                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

					                                <div class="col-md-6">
					                                    <input id="name" type="text"
					                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
					                                           name="name" value="{{ old('name') }}" required autofocus>

					                                    @if ($errors->has('name'))
					                                        <span class="invalid-feedback">
					                                        <strong>{{ $errors->first('name') }}</strong>
					                                    </span>
					                                    @endif
					                                </div>
					                            </div>

					                            <div class="form-group row">
					                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

					                                <div class="col-md-6">
					                                    <input id="email" type="email"
					                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
					                                           name="email" value="{{ old('email') }}" required>

					                                    @if ($errors->has('email'))
					                                        <span class="invalid-feedback">
					                                        <strong>{{ $errors->first('email') }}</strong>
					                                    </span>
					                                    @endif
					                                </div>
					                            </div>

					                            <div class="form-group row">
					                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

					                                <div class="col-md-6">
					                                    <input id="password" type="password"
					                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
					                                           name="password" required>

					                                    @if ($errors->has('password'))
					                                        <span class="invalid-feedback">
					                                        <strong>{{ $errors->first('password') }}</strong>
					                                    </span>
					                                    @endif
					                                </div>
					                            </div>

					                            <div class="form-group row">
					                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
					                                    Password</label>

					                                <div class="col-md-6">
					                                    <input id="password-confirm" type="password" class="form-control"
					                                           name="password_confirmation" required>
					                                </div>
					                            </div>

					                            <div class="form-group row mb-0">
					                                <div class="col-md-6 offset-md-4">
					                                    <button type="submit" class="btn btn-primary">
					                                        Register
					                                    </button>
					                                </div>
					                            </div>
					                        </form>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
				    </div>

				    <div id="createEvent" class="content">
				        	<div class="row" >
					            <form method="post" class="contact1-form validate-form" action="{{route('admin.events.store')}}" style="width: 80%" align="center">
	            					@csrf
	            					<h3>Create Event</h3>
	            					<hr style="height: 2px; color:#1C2833; background:#1C2833;">
	            					<div class="row"> <!-- first row -->
	            						<div class="col-md-6">
	            						 <label >Event name:<input type="text" name="name" placeholder="Name" class="form-control" style="width: 100%" size="300" ></label>
						                    @if($errors->has('name'))
						                        <span class="help-block">{{ $errors->first('name') }}</span>
						                    @endif
	            						</div>
		            					<div class="col-md-3">
		            						<label>Category
					                            <div class="input-group mb-3">
					                                <div class="input-group-prepend">
					                                    <label class="input-group-text" for="inputGroupSelect01">Category</label>
					                                </div>
					                                <select class="custom-select" id="category_selector" name="category_id">
					                                    <option value="" selected disabled hidden>Select category</option>
					                                    <option value="1">Adventure</option>
					                                    <option value="2">Dance</option>
					                                    <option value="3">Food</option>
					                                    <option value="4">Movement</option>
					                                    <option value="5">Movie</option>
					                                    <option value="6">Other</option>
					                                </select>
					                            </div>
					                    	</label>
						                    @if($errors->has('category'))
						                        <span class="help-block">{{ $errors->first('category') }}</span>
						                    @endif
		            					</div>
		            					<div class="col-md-3">
		            						<label>Maximum Attendee:<input type="number" name="max_capacity" placeholder="Attendee number"
                                                   min="0" class="form-control"></label>
						                    @if($errors->has('max_capacity'))
						                        <span class="help-block">{{ $errors->first('max_capacity') }}</span>
						                    @endif
								        </div>
	            					</div>

	            					<div class="row"> <!-- second row -->
	            						<div class="col-md-3">
	            							<label>Event fee (Baht) <input type="float" name="price" placeholder="0" class="form-control"></label>
						                    @if($errors->has('price'))
						                        <span class="help-block">{{ $errors->first('price') }}</span>
						                    @endif
	            						</div>
	            						<div class="col-md-3">
	            							 <label>Pay fee before: <input type="datetime-local" name="payment_time"
                                                  class="form-control"></label>
						                    @if($errors->has('payment_time'))
						                        <span class="help-block">{{ $errors->first('payment_time') }}</span>
						                    @endif
	            						</div>
	            						<div class="col-md-3">
	            							<label>Location <input type="text" name="location" placeholder="Location"
                                           class="form-control"></label>
						                    @if($errors->has('location'))
						                        <span class="help-block">{{ $errors->first('location') }}</span>
						                    @endif
	            						</div>
	            						<div class="col-md-3">
	            							<label>Event start time: <input type="datetime-local" name="start_time"
                                                    class="form-control"></label>
						                    @if($errors->has('start_time'))
						                        <span class="help-block">{{ $errors->first('start_time') }}</span>
						                    @endif
	            						</div>
	            					</div>

	            					<div class="col-md-12">
					                    <label>Detail:<textarea rows="10" cols="80" name="detail" placeholder="Detail" class="form-control"></textarea></label>
					                    @if($errors->has('detail'))
					                        <span class="help-block">{{ $errors->first('detail') }}</span>
					                    @endif
	            					</div>
	            					
	            					<div class="col-md-12">
	            						<input type="hidden" value="{{Auth::id()}}" name="organizer_id">

               							 <button type="submit" class="btn btn-primary">Create!</button>
	            					</div>
	            					
            					
				            	</form>
				     		</div>
   					</div>


    			</div>
    	</div>
    </div>
    
@endsection