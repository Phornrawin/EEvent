@extends('layouts.master')

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
            {{$event->cur_capacity .' / ' .$event->max_capacity}}
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

        @if(!$event->isAttend(Auth::id()))
            <form method="post" action="{{route('events.attend', ['id' => $event->id])}}">
                @csrf
                <button class="btn btn-primary" type="submit">I'm going</button>
            </form>
        @else
            <form method="post" action="{{route('events.unattend', ['id' => $event->id])}}">
                @csrf
                <button class="btn btn-danger" type="submit">I'cant go anymore</button>
            </form>
        @endif
    </div>
@endsection