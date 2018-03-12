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
                <h4 class="mb-4 font-weight-light">Tell us about yourself</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" class="contact1-form validate-form" action="{{route('profile.update.bio')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="email">Age <span class="text-muted">(Optional)</span></label>
                        <input class="form-control lato" type="text" name="age"
                               value="{{$user->profile->age == 0 ? '' : $user->profile->age}}">
                    </div>

                    <div class="mb-3">
                        <label for="Age">Telephone Number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">TEL</span>
                            </div>
                            <input class="form-control lato" placeholder="eg. 0805556789" type="text" name="tel_phone"
                                   value="{{$user->profile->tel_phone}}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Save</button>
                    <div class="mb-3 text-muted py-3 stripe">
                        Your biography is not required but it would help the community to know you more.
                    </div>
                </form>
            </div>
@endsection