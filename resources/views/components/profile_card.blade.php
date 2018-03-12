<div class="card box-shadow ">
    <div class="card-header bg-firewatch">
        <div class="card-img-top text-center py-3">
            <img src="uploads/avatars/{{$user->avatar}}"
                 style="max-width: 100px; max-height: 100px; width: 100%; border-radius: 50%; border: 4px solid white">
            <div class="text-center text-light font-weight-bold mt-2">
                {{$user->name}}
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <a class="card-button" href="{{route('profile.show')}}"><i class="fa fa-home"></i> Overview </a>
        <a class="card-button" href="{{route('profile.edit')}}"><i class="fa fa-gear"></i> Account
            Setting </a>
        <a class="card-button" href="{{route('profile.edit')}}"><i class="fa fa-book"></i> Edit Bio </a>
    </div>
    <div class="card-footer text-center">
        <a class="btn btn-danger " href="{{route('logout')}}"> Logout</a>
    </div>
</div>