<?php

namespace EEvent\Http\Controllers;

use Auth;
use EEvent\Attendee;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function checkIn($event_id)
    {

        $attendee = Attendee
            ::where('event_id', '=', $event_id)
            ->where('user_id', '=', Auth::id())
            ->first();
        if (!$attendee) {
            return redirect()->route('events.show', ['id' => $event_id])->with('error', 'You is not invited here!');
        }
        if ($attendee->check_in != true) {
            $attendee->check_in = true;
            $attendee->save();
            return redirect()->route('events.show', ['id' => $event_id])->with('success', 'You had check in !');
        }
        return redirect()->route('events.show', ['id' => $event_id])->with('warning', 'You had already been checked in !');
    }

    public function changeStatus(Request $request)
    {
        $attendee = Attendee::find($request->get('id'));
        if (!$attendee) {
            return back()->with('error', 'Something went wrong!');
        }
        if ($request->get('accepted')) {
            $attendee->accept = true;
            $attendee->save();
            return back()->with('success', 'He or she had been invited!');
        } else {
            try {
                $attendee->delete();
                return back()->with('success', 'Reject success !');
            } catch (\Exception $e) {
                return back()->with('error', 'Something went wrong!');
            }
        }
    }
}
