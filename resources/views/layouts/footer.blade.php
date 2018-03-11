<footer class="font-weight-light text-light bg-dark pt-4">
    <!--Footer Links-->
    <div class="container text-center text-md-left">
        <div class="row">

            <!--First column-->
            <div class="col-md-4">
                <h4 class="text-uppercase mb-4 mt-3 font-weight-bold">EEvent</h4>
                <p>EEvent is a place you can meet-up people who has enthusiasm in the same thing as
                    you do. Meet up and do everything at everywhere.
                </p>
            </div>
            <!--/.First column-->

            <hr class="clearfix w-100 d-md-none">

            <!--Second column-->
            <div class="col-md-2 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Links</h5>
                <ul class="list-unstyled item">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--/.Second column-->

            <hr class="clearfix w-100 d-md-none">

            <!--Third column-->
            <div class="col-md-2 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--/.Third column-->


            <!--Fourth column-->
            <hr class="clearfix w-100 d-md-none">
            <div class="col-md-2 mx-auto">
                <h5 class="text-uppercase mb-4 mt-3 font-weight-bold">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!">Link 1</a>
                    </li>
                    <li>
                        <a href="#!">Link 2</a>
                    </li>
                    <li>
                        <a href="#!">Link 3</a>
                    </li>
                    <li>
                        <a href="#!">Link 4</a>
                    </li>
                </ul>
            </div>
            <!--/.Fourth column-->
        </div>
    </div>
    <hr>

    <!--call to action-->
    @guest
        <div class="text-center py-3">
            <ul class="list-unstyled list-inline mb-0">
                <li class="list-inline-item">
                    <h5 class="mb-1">Register for free</h5>
                </li>
                <li class="list-inline-item">
                    <a href="{{route('register')}}" class="btn btn-danger btn-rounded">Sign up!</a>
                </li>
            </ul>
        </div>
    @endguest

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