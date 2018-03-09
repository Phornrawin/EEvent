@extends('layouts.master')

@section('title', 'Create an Event - EEvent');

@section('content')
    <div class="container">
        <div class="row">
            <h1>Create your event here!</h1>
            <br>

            <form method="post" class="contact1-form validate-form">
                {{ csrf_field() }}

                <label>Event name:<input type="text" name="name" placeholder="Name" class="form-control"></label>
                @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif

                <label>Maximum Attendee:<input type="number" name="max_capacity" placeholder="Attendee number" min="0" class="form-control"></label>
                @if($errors->has('max_capacity'))
                    <span class="help-block">{{ $errors->first('max_capacity') }}</span>
                @endif

                <label>Detail:<textarea name="detail" placeholder="Detail" class="form-control"></textarea></label>
                @if($errors->has('detail'))
                    <span class="help-block">{{ $errors->first('detail') }}</span>
                @endif

                <label>Location <input type="text" name="location" placeholder="Location" class="form-control"></label>
                @if($errors->has('location'))
                    <span class="help-block">{{ $errors->first('location') }}</span>
                @endif

                <label>Event fee <input type="float" name="price" placeholder="0" class="form-control"></label>
                @if($errors->has('price'))
                    <span class="help-block">{{ $errors->first('price') }}</span>
                @endif
                {{--<select>--}}
                    {{--<option value="food">sci-fi</option>--}}
                    {{--<option value="consert">sci-fi</option>--}}
                {{--</select>--}}
                <label>Category <textarea type="combobox" name="category" class="form-control"></textarea></label>
                @if($errors->has('category'))
                    <span class="help-block">{{ $errors->first('category') }}</span>
                @endif

                <label>Event start time: <input type="datetime-local" name="start_time" class="form-control"></label>
                @if($errors->has('start_time'))
                    <span class="help-block">{{ $errors->first('start_time') }}</span>
                @endif

                <label>Pay fee before: <input type="datetime-local" name="payment_time" class="form-control"></label>
                @if($errors->has('payment_time'))
                    <span class="help-block">{{ $errors->first('payment_time') }}</span>
                @endif

                <input type="hidden" value="{{Auth::id()}}" name="organizer_id">

                <button type="submit">Create!</button>
            </form>
        </div>
    </div>
@endsection