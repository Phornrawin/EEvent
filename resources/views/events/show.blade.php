@extends('layouts.app')

@section('content')
    <div>
        <p>Title: {{$event->name}}</p>
        <p>Time: {{$event->start_time. ' to ' . $event->end_time}}</p>
        <p>Tag: {{$event->category}}</p>
        @if ($event->price == 0)
            <p>Price: free</p>
        @else
            <p>Price: {{$event->price}}</p>
        @endif
        <div>
            Organizer:{{$event->organizer->user->name}}
        </div>
        <div>
            Attendee:
            @foreach($event->attendees as $attendee)
                <div>User: {{$attendee->user->name}}</div>
                <div>Email: {{$attendee->user->email}}</div>
                @if($attendee->payment != null)
                    <div>Payment: {{$attendee->payment->payment_time}}</div>
                    <br>
                @endif
            @endforeach
        </div>
    </div>
@endsection