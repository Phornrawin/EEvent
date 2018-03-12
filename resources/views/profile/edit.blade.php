@extends('layouts.master')

@section('content')
    @if (session('success'))
        <script>swal("Success!", "{{session('success')}}", "success");</script>
    @endif
    <div class="container">
        <div class="row position-relative">
            <div class="col-md-3 my-5">
                @include('components.profile_card')
            </div>

            <div class="col-md-7 ml-md-3 my-5 p-sm-5 box-shadow bg-white rounded">
                <h4 class="mb-4 font-weight-light">Account Settings</h4>
                <form method="post" class="contact1-form validate-form" action="{{route('profile.update')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="username">Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input class="form-control" placeholder="Username" required="" type="text" name="name"
                                   value="{{$user->name}}">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input class="form-control" placeholder="you@example.com" type="email" name="email"
                               value="{{$user->email}}">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection


{{--<h2>Change Password</h2>--}}

{{--@if (session('alert2'))--}}
{{--<div class="alert alert-success" style="color: #e60000; background-color: #ffb3b3">--}}
{{--{{ session('alert2') }}--}}
{{--</div>--}}
{{--@endif--}}
{{--<label style="font-size: 18px">Your current password</label>--}}
{{--<input type="password" name="currentPass" value="" class="form-control"--}}
{{--size="100">--}}
{{--<br>--}}
{{--@if (session('alert1'))--}}
{{--<div class="alert alert-success" style="color: #e60000; background-color: #ffb3b3">--}}
{{--{{ session('alert1') }}--}}
{{--</div>--}}
{{--@endif--}}
{{--<label style="font-size: 18px">Your new password</label>--}}
{{--<input type="password" name="password" value="" class="form-control"--}}
{{--size="100">--}}
{{--<br>--}}
{{--<label style="font-size: 18px">Retype your new password</label>--}}
{{--<input type="password" name="retypeNewPass" value="" class="form-control"--}}
{{--size="100">--}}
{{--</div>--}}
{{--</div>--}}
{{--<br>--}}
{{--<input type="hidden" value="{{Auth::id()}}" name="user_id">--}}

