<?php

namespace EEvent\Http\Controllers;

use Auth;
use chillerlan\QRCode\QRCode;
use EEvent\Attendee;
use EEvent\Event;
use EEvent\Mail\AttendingMailer;
use EEvent\Payment;
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
        $events = Event::simplePaginate(3); //test
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

//        Event::create($request->all());
        $data = $request->validate([
            'name' => 'required|max:255',
            'max_capacity' => 'required|min:1',
            'detail' => 'required',
            'location' => 'required',
            'category_id' => 'required|min:1',
            'price' => 'required|min:>=0',
            'payment_time' => 'required|',
            'start_time' => 'required',
        ]);
        $data += array("image_path" => $request['img']);

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
        try {
            $qrcode = (new QRCode)->render('https://www.youtube.com/watch?v=DLzxrzFCyOs&t=43s');
            $event = Event::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('events.search', ['q' => $id]);
        }
        return view('events.show', ['event' => $event, 'code' => $qrcode]);
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
                'max_capacity' => 'required|',
                'detail' => 'required',
                'location' => 'required',
                'category_id' => 'required|min:1',
                'price' => 'required|min:0',
                'payment_time' => 'required|',
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
        $events = Event::where('name', 'like', '%' . $query . '%')->simplePaginate(3);
        session()->flash('q', $query);
        return view('events.index', ['events' => $events, 'query' => $query]);
    }

    public function attend(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event->cur_capacity < $event->max_capacity) {
            Mail::to($request->user())->send(new AttendingMailer($event));
            $attendees = $event->attendees()->create([
                "user_id" => Auth::id()
            ]);
            $attendees->payment()->create();
            $event->cur_capacity += 1;
            $event->save();
            $attendees->save();
        } else {
            back()->withErrors(['msg' => 'The events is full']);
        }
        return back()->with('success', 'You are going there!');
    }

    public function unAttend(Request $request, $id)
    {
        $attendee = Attendee
            ::where('event_id', '=', $id)
            ->where('user_id', '=', Auth::id())->first();
        $payment = Payment::where('attendee_id', '=', $attendee->id);
        try {
            if ($attendee != null and $payment != null) {
                $event = Event::find($id);
                $event->cur_capacity -= 1;
                $payment->delete();
                $attendee->delete();
                $event->save();
            }
        } catch (\Exception $e) {
            back()->withErrors('msg', 'Something went wrong!!');
        }
        return back()->with('success', 'You not going there anymore!');
    }

}
