@extends('layouts.app')

@section('content')
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
@endsection