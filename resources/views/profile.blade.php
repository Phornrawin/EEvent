@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <img src="uploads/avatars/{{$user->avatar }}"
                     style="width: 150px; height: 150px; float: left; border-radius: 50%;margin-right: 20px">
                <h2>Hi! {{$user->name}}</h2>
                <form enctype="multipart/form-data" action="{{route('profile')}}" method="POST">
                    <label> Update Profile Image</label>
                    <input type="file" name="avatar" accept=".jpg, .png">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit">ok</button>
                </form>
            </div>
        </div>
    </div>
@endsection