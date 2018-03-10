<?php
	session_start();
	$user = $_SESSION['user'];
?>
@include('layouts.app')
	<h1>Hello World</h1>
	<h1>{{$user->name}}</h1>
@section('content')
	
@endsection
	