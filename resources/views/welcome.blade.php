@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column text-center justify-content-center pb-xl-5" style="height: 100vh;background-image: url(http://daxushequ.com/data/out/48/img60583455.jpg)">
            <div>
                <h1 class="display-1" style="color: white">EEvent</h1>
                <p style="color: white">[ Where Everything meets Everywhere ]</p>
                <div>
                    <a class="btn btn-success m-2" href={{route('login')}}>Join Us</a>
                </div>
            </div>
        </div>
        <div class="d-flex jumbotron justify-content-center">
            <form class="">
                <p>search by:</p>
                <input type="text" class="form-text">
            </form>
        </div>
    </div>   
@endsection