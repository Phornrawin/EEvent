@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Create your event here!</h1>
            <br>

            <form method="post" class="contact1-form validate-form">

                <label>Event name:<input type="text" name="name" placeholder="Name"></label>

                <label>Maximum Attendee:<input type="number" name="max_capacity" placeholder="Attendee number" min="0"></label>

                <label>Event date:<input type="date" name="event_date" placeholder="Event date"></label>

                <label>Detail:<textarea name="message" placeholder="Detail"></textarea></label>
                <label>Location <input type="text" name="location" placeholder="Location"></label>
                <span class="shadow-input1"></span>
                {{--<input type="checkbox">--}}
                
                <div class="container-contact1-form-btn">
                    <button class="contact1-form-btn">
						<span>
							Send Email
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
{{--                            {{route('store', ['id' => $event->id])}}--}}
						</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection