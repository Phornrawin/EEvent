<?php

namespace EEvent\Http\Controllers;

use Auth;
use Carbon\Carbon;
use chillerlan\QRCode\QRCode;
use EEvent\Attendee;
use EEvent\Category;
use EEvent\Event;
use EEvent\Mail\AttendingMailer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mail;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $events = Event::simplePaginate(9); //test
        return view('events.index', ['events' => $events]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('events.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        $payment_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('payment_time'));
//        $start_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('start_time'));


//        Event::create($request->all());
        $data = $request->validate([
            'name' => 'required|max:255',
            'precondition' => 'required',
            'max_capacity' => 'required|min:1',
            'detail' => 'required',
            'location' => 'required',
            'category_id' => 'required|min:1',
            'price' => 'required|min:0',
            'payment_time' => 'required',
            'start_time' => 'required'
        ]);

        if (isset($request['image_path'])) {
            $this->validate($request, [
                'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image_path->getClientOriginalExtension();
            $request->image_path->move(public_path('uploads/events_pic'), $imageName);
            $data += array('image_path' => $imageName);
        }

        $code = random_int(100000, 999999);

        $data += array('organizer_id' => $request['organizer_id']) + array('code' => $code);
        $data['start_time'] = date("Y-m-d h:i:s", strtotime($data['start_time']));
        $data['payment_time'] = date("Y-m-d h:i:s", strtotime($data['payment_time']));

        Event::create($data);

        return redirect('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return redirect()->route('events.search', ['q' => $id]);
        }

        if ($event->organizer_id == Auth::id()) {
            $requested = $event->attendees->where('accept', '=', false);
            $accepted = $event->attendees->where('accept', '=', true);
            $checkin = $event->attendees->where('check_in', '=', true);
            $qrcode = (new QRCode)->render(action('AttendeeController@checkIn', ['event_id' => $id]));
            return view('events.organizer', [
                'event' => $event,
                'code' => $qrcode,
                'requested' => $requested,
                'accepted' => $accepted,
                'checkin' => $checkin]);
        } else {
            return view('events.show', ['event' => $event]);
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('events.edit', ["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event != null) {
            $data = $request->validate([
                'name' => 'required|max:255',
                'precondition' => 'required',
                'max_capacity' => 'required|min:' . $event->cur_capacity,
                'detail' => 'required',
                'location' => 'required',
                'category_id' => 'required|min:1',
                'price' => 'required|min:0',
                'payment_time' => 'required',
                'start_time' => 'required',
            ]);
            $data['start_time'] = date("Y-m-d h:i:s", strtotime($data['start_time']));
            $data['payment_time'] = date("Y-m-d h:i:s", strtotime($data['payment_time']));

            if (isset($request['image_path'])) {
                $this->validate($request, [
                    'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $imageName = time() . '.' . $request->image_path->getClientOriginalExtension();
                $request->image_path->move(public_path('uploads/events_pic'), $imageName);
                $data += array('image_path' => $imageName);
            }


            $event->update($data);
        }

        return redirect()->route('events.show', ['id' => $id])->with('success', 'Your event has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        try {
            $event->delete();
        } catch (\Exception $e) {
        }
        return redirect('profile');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $events = Event::where('name', 'like', '%' . $query . '%')->simplePaginate(9);
        session()->flash('q', $query);
        return view('events.index', ['events' => $events, 'query' => $query]);
    }

    public function searchCat($q)
    {
        $events = Category::where('name', '=', $q)->first()->events()->simplePaginate(9);
        session()->flash('q', $q);
        return view('events.index', ['events' => $events, 'query' => $q]);
    }

    public function attend(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event->cur_capacity < $event->max_capacity) {
            $attendees = $event->attendees()->create([
                "user_id" => Auth::id()
            ]);
            $event->cur_capacity += 1;
            $event->save();
            $attendees->save();
            if ($event->price != 0) {
                $attendees->payment()->create(['status' => 'unpaid']);
            }
        } else {
            back()->withErrors(['msg' => 'The events is full']);
        }
        return redirect()->route('events.show', ['id' => $id])->with('success', 'You are going there!');
    }

    public function unAttend(Request $request, $id)
    {
        $attendee = Attendee
            ::where('event_id', '=', $id)
            ->where('user_id', '=', Auth::id())->first();
        try {
            if ($attendee != null) {
                $event = Event::find($id);
                $event->cur_capacity -= 1;
                $attendee->delete();
                $event->save();
            }
        } catch (\Exception $e) {
            back()->withErrors('msg', 'Something went wrong!!');
        }
        return back()->with('success', 'You not going there anymore!');
    }

}
