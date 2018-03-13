@extends('layouts.app')
 
@section('content')
 	<style type="text/css">
		
		/* Style the tab content */
		.table{
		    padding: 0px 12px;
		    border: 1px solid #ccc;
		    width: 80%;  
		}

		#map{
		    height: 300px;
		    width: 500px;
		    margin: auto;
		    clear:both;
		}
		#summit{
			width: 30%
			height: 20%;
		}


    </style>
    <script type="text/javascript" src="{{asset('js/load_map_foradmin.js')}}"></script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk&callback=initMap"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js')}}"></script>

    <script type="text/javascript" src="tableExport.js"></script>
	<script type="text/javascript" src="jquery.base64.js"></script>
	<script type="text/javascript" src="html2canvas.js"></script>
	<script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="jspdf/jspdf.js"></script>
	<script type="text/javascript" src="jspdf/libs/base64.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


	<?php
		mysql_connect('localhost', 'root');
		mysql_select_db('eevent');
		 
		 
		 $qry="SELECT * FROM users";
		 $result=mysql_query($qry);
		 
		 
		 $recordUsers = array();
		 
		 while($row = mysql_fetch_assoc($result)){ 
		    $recordUsers[] = $row;
		  }

		$qry2 = "SELECT * FROM event";
		$result2 = mysql_query($qry2);

		$recordEvents = array();

		while($row = mysql_fetch_assoc($result2)){ 
		    $recordEvents[] = $row;
		  }

	 
	?>
	<div id="usersTable" class="row content" style="height:300px;overflow:scroll;">
        <table id="users" class="table table-striped">
			<thead>         
			    <tr class="warning">
			        <th>Id</th>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Role</th>
			    </tr>
			</thead>
			<tbody>
			    <?php foreach($recordUsers as $rec):?>
			        <tr>
			            <td><?php echo $rec['id']?></td>
			            <td><?php echo $rec['name']?></td>
			            <td><?php echo $rec['email']?></td>
			            <td><?php echo $rec['role']?></td>
			        </tr>
			    <?php endforeach; ?>
	        </tbody>
        </table>
	</div>

    
    <div class="content">
    	<div class="row">
    			<div class="col-md-2 bg-dark" style="color: white" >
    				<br>
    				<h3 align="center">Manage EEvent</h3>
    				<br>
    				<div class="vertical-menu">
    					<ul>
    						<li><h5><span href="" onclick="onClickUser()" id="defaultOpen">Users</span></h4></li>
    						<hr style="background-color: white">
							<li><h5><span href="" onclick="onClickEvent()">Events</span></h4></li>
							<hr style="background-color: white">
							<li><h5><span href="" onclick="onClickCreateUser()">Create user</span></h4></li>
							<hr style="background-color: white">
							<li><h5><span href="" onclick="onClickCreateEvent()">Create event</span></h4></li>
    					</ul>
					</div>
    			</div>

    			<div class="col-md-10"  style="width: 70%; padding: : 10px; align-content: center;"  ng-app="sortApp" >
    				<br>

    				 <div id="users" class="content" ng-controller="userController">
    				 	<h3>Users Table</h3>
    				 	<hr style="height: 1px; color:white; background:#1C2833;">
    				 	<form>
	                        <div class="w-100">
					    <form method="get" action="{{route('events.search')}}">
					        <div class="input-group">
					            <input type="text" name="q" class="search form-control form-control-dark rounded-0 py-3"
					                   placeholder="Search  Events "
					                   value="{{session()->has('q') ? session('q') : ''}}" ng-model="searchName">
					            <div class="input-group-append d-none d-md-flex">
					                <button class="btn rounded-0" id="basic-addon" style="min-width: 100px; background-color: #424B55; color: white" ><i
					                            class="fa fa-search"></i></button>
					            </div>
					        </div>
					    </form>
					</div>
					<br>
                    	</form>
    				 	
				        <table class="table table-bordered table-striped">

							<table class="table table-bordered table-striped">
		                        <tr>
		                            <td>
		                                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
		                                    Name
		                                    <span ng-show="sortType == 'name' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'email'; sortReverse = !sortReverse">
		                                    Email
		                                    <span ng-show="sortType == 'email' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'email' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'avatar'; sortReverse = !sortReverse">
		                                    Avatar
		                                    <span ng-show="sortType == 'avatar' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'avatar' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                        </tr>

	                        <tr ng-repeat="user in users | orderBy:sortType:sortReverse | filter:searchName">
	                            <td><% user.name %></td>
	                            <td><% user.email %></td>
	                            <td><% user.avatar %></td>
	                            <td><a href="#" ng-click="editView(user.id)">edit</a></td>
	                            <td><a href="#" ng-click="deleteUser(user.id)">delete</a></td>
	                        </tr>
                    	</table>  
                    	 <li><a href="#" onclick="$('#users').tableExport({type:'pdf',escape:'false'});"> <img src="images/json.jpg" width="24px">PDF</a></li>
                         
    				</div>
    				<div id="events" class="content" ng-controller="eventController">
    					<h3>Events Table</h3>
    					<hr style="height: 2px; color:#1C2833; background:#1C2833;">
                    	<div class="w-100">
					    <form method="get" action="{{route('events.search')}}">
					        <div class="input-group">
					            <input type="text" name="q" class="search form-control form-control-dark rounded-0 py-3"
					                   placeholder="Search  Events "
					                   value="{{session()->has('q') ? session('q') : ''}}" ng-model="searchName">
					            <div class="input-group-append d-none d-md-flex">
					                <button class="btn rounded-0" id="basic-addon" style="min-width: 100px; background-color: #424B55; color: white" ><i
					                            class="fa fa-search"></i></button>
					            </div>
					        </div>
					    </form>
					</div>
					<br>
                    	

							<table class="table table-bordered table-striped">
		                        <tr>
		                            <td>
		                                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
		                                    ID
		                                    <span ng-show="sortType == 'name' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'email'; sortReverse = !sortReverse">
		                                    Name
		                                    <span ng-show="sortType == 'email' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'email' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'precondition'; sortReverse = !sortReverse">
		                                    Precondition
		                                    <span ng-show="sortType == 'precondition' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'precondition' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'location'; sortReverse = !sortReverse">
		                                    Location
		                                    <span ng-show="sortType == 'location' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'location' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'code'; sortReverse = !sortReverse">
		                                    Code
		                                    <span ng-show="sortType == 'code' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'code' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'price'; sortReverse = !sortReverse">
		                                    Price
		                                    <span ng-show="sortType == 'price' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'price' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'payment_time'; sortReverse = !sortReverse">
		                                    Payment_time
		                                    <span ng-show="sortType == 'payment_time' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'payment_time' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'start_time'; sortReverse = !sortReverse">
		                                    Start_time
		                                    <span ng-show="sortType == 'start_time' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'start_time' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'cur_capacity'; sortReverse = !sortReverse">
		                                    Cur_capacity
		                                    <span ng-show="sortType == 'cur_capacity' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'cur_capacity' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'max_capacity'; sortReverse = !sortReverse">
		                                    Max_capacity
		                                    <span ng-show="sortType == 'max_capacity' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'max_capacity' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
		                                    Created_at
		                                    <span ng-show="sortType == 'created_at' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'created_at' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                            <td>
		                                <a href="#" ng-click="sortType = ' updated_at'; sortReverse = !sortReverse">
		                                    Updated_at
		                                    <span ng-show="sortType == 'updated_at' && !sortReverse"
		                                          class="fa fa-caret-down"></span>
		                                    <span ng-show="sortType == 'updated_at' && sortReverse"
		                                          class="fa fa-caret-up"></span>
		                                </a>
		                            </td>
		                        </tr>

	                        <tr ng-repeat="event in events | orderBy:sortType:sortReverse | filter:searchName">
	                            <td><% event.id %></td>
	                            <td><% event.name %></td>
	                            <td><% event.precondition %></td>
	                            <td><% event.location %></td>
	                            <td><% event.code %></td>
	                            <td><% event.price %></td>
	                            <td><% event.payment_time %></td>
	                            <td><% event.start_time %></td>
	                            <td><% event.cur_capacity %></td>
	                            <td><% event.max_capacity %></td>
	                            <td><% event.created_at %></td>
	                            <td><% event.updated_at %></td>
	                            <td><a href="#" ng-click="editView(event.id)">edit</a></td>
	                            <td><a href="#" ng-click="deleteUser(event.id)">delete</a></td>
	                        </tr>
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
				        	<div class="row" style="margin: 10px">
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

	            					<div class="row" align=" center"> <!-- second row -->
	            						<div class="col-md-4">
	            							<label>Event fee (Baht) <input type="float" name="price" placeholder="0" class="form-control"></label>
						                    @if($errors->has('price'))
						                        <span class="help-block">{{ $errors->first('price') }}</span>
						                    @endif
	            						</div>
	            						<div class="col-md-4">
	            							 <label>Pay fee before: <input type="datetime-local" name="payment_time"
                                                  class="form-control"></label>
						                    @if($errors->has('payment_time'))
						                        <span class="help-block">{{ $errors->first('payment_time') }}</span>
						                    @endif
	            						</div>
	            					
	            						<div class="col-md-4">
	            							<label>Event start time: <input type="datetime-local" name="start_time"
                                                    class="form-control"></label>
						                    @if($errors->has('start_time'))
						                        <span class="help-block">{{ $errors->first('start_time') }}</span>
						                    @endif
	            						</div>
	            					</div>

	            					<div class="row">
	            						<div class="col-md-6">
								            <div class="row input-group-prepend">
							                    <label>Location <input id="location" type="textbox" name="location" placeholder="Location" class="form-control" size="300" style="width: 100%"></label>
							                    @if($errors->has('location'))
							                        <span class="help-block">{{ $errors->first('location') }}</span>
							                    @endif

							                    <input id="submit" type="button" value="Show on map" class="form-control btn btn-primary" style="width: 30%; align-items: center;" >
							                </div>

							                <div id="map"></div>
	            						</div>
	            						<div class="col-md-6">
	            							<div class="form-group">
							                    <label>Precondition<textarea id="precondition" name="precondition" class="form-control" row="20"
							                                                 cols="50" style="height:350px"></textarea></label>
							                    @if($errors->has('precondition'))
							                        <span class="help-block alert alert-danger">{{ $errors->first('precondition') }}</span>
							                    @endif
							                </div>
	            						</div>
	            					</div>
	            					<br>	
		            					<div class="col-md-12">
						                    <label>Detail:
						                    	<br><textarea rows="15" cols="80" name="detail" placeholder="Detail" class="form-control"></textarea></label>
						                    @if($errors->has('detail'))
						                        <span class="help-block">{{ $errors->first('detail') }}</span>
						                    @endif
		            					</div>
	            					<br>
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