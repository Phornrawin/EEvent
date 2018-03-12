<html lang="{{ app()->getLocale() }}">
<head>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC48dOHizV6KELoop9nwltS-pNGZ9FHfdk">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('js/load_map.js')}}"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <script src="https://use.fontawesome.com/ebc57c5fe2.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/map.css')}}">

</head>


<body>
<div style="height: 200px; border: #ff4a5f">
    <h2 style="text-align: center; font-family: Verdana,sans-serif">{{$event->name}}</h2>
    <h3 style="text-align: center; font-family: Verdana,sans-serif">Hosted by {{$event->organizer->name}}</h3>
    <p style="text-align: center; font-family: Verdana,sans-serif">At: {{$event->location}}</p>
</div>


<div style="text-align: center">
    <form method="post" action="{{action('EventController@unAttend', $event->id)}}">
        @csrf
        <input style="border: none; border-radius: 5px; background-color: #ff4a5f; padding: 20px; font-size: 120%; color: white"
               value=' Click here if you change your mind' type="submit">
    </form>
</div>

</body>
</html>