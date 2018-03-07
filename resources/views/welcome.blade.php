@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column text-center justify-content-center pb-xl-5" style="height: 100vh">
            <div>
                <h1 class="display-1">EEvent</h1>
                <p>[ Where Everything meets Everywhere ]</>
                <div>
                    <a class="btn btn-success m-2" href={{route('login')}}>Join Us</a>
                </div>
            </div>
        </div>
        <div class="d-flex jumbotron justify-content-center">
            <form class="">
                <input type="text" class="form-text">
            </form>
        </div>
    </div>
@endsection