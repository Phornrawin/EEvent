<?php

namespace EEvent\Http\Controllers;

use Auth;
use chillerlan\QRCode\QRCode;
use EEvent\Attendee;
use EEvent\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
            'price' => 'required|min:0',
            'payment_time' => 'required|',
            'start_time' => 'required',
        ]);

        $code = random_int(100000, 999999);

        $data += array('organizer_id' => $request['organizer_id']) + array('code' =>$code);
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
            $event->update($request->all());
        }
        return back();
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
        $events = Event
            ::where('name', 'like', '%' . $query . '%')->get();

        return view('events.search', ['events' => $events]);
    }

    public function attend(Request $request, $id)
    {
        $event = Event::find($id);
        if ($event->cur_capacity < $event->max_capacity) {
            $event->attendees()->create([
                "user_id" => Auth::id()
            ]);
            $event->cur_capacity += 1;
            $event->save();
        } else {
            back()->withErrors(['msg' => 'The events is full']);
        }
        return back();
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
        return back()->with('success', 'Your event had been deleted!');
    }

}
