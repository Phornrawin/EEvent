@extends('layouts.app')

@section('content')
    <div class="container w-75 mx-auto">
        <h1>EDIT</h1>
        <hr>
        <form method="post" action="{{route('admin.users.update', ['id' => $user->id])}}">
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mx-sm-3" id="name" name="name" placeholder="Name"
                           value="{{$user->name}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-5 my-1">
                    <label for="name">Email</label>
                    <input type="email" class="form-control mx-sm-3" id="email" name="email" placeholder="Email"
                           value="{{$user->email}}">
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-1 my-3">
                    <button type="submit" class="btn btn-primary form form-control mx-sm-3">Save</button>
                </div>
            </div>
        </form>
    </div>

@endsection