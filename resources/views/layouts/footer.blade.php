<footer class="font-weight-light text-light bg-dark pt-4">

    @guest
        <div class="text-center py-3">
            <h4 class="text-uppercase mb-4 mt-3 font-weight-bold">EEvent</h4>
            <h5>Be part of the community, try something new with new people.
            </h5>
            <a href="{{route('register')}}" class="btn btn-danger btn-rounded mt-3">Join us!</a>
        </div>
    @endguest

    <hr>

    <div class="text-center">
        <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
                <a class="btn mx-1">
                    <i class="fa fa-facebook"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn mx-1">
                    <i class="fa fa-twitter"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn mx-1">
                    <i class="fa fa-google-plus"> </i>
                </a>
            </li>
        </ul>
    </div>

    <div class="py-3 text-center">
        © 2018 Copyright: Design By eiei12345
    </div>
</footer>