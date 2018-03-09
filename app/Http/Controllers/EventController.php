<?php

namespace EEvent\Http\Controllers;

use Auth;
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
        $events = Event::all();
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
            'category' => 'required',
            'price' => 'required|min:0',
            'payment_time' => 'required|',
            'start_time' => 'required',
        ]);

//        $data = $request;
        $data += array('organizer_id' => $request['organizer_id'], 'code' => "12341234", 'end_time' => "2018-03-23 05:47:07");
        $data['start_time'] = date("Y-m-d", strtotime($data['start_time']));
        $data['payment_time']= date("Y-m-d", strtotime($data['payment_time']));

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
        return view('events.show', ['event' => $event]);
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
        $events = Event::where("name", "like", '%' . $query . '%')->get();
        return view('events.search', ['events' => $events]);
    }

    public function attend(Request $request)
    {
        $event_id = $request->get('id');
        Event::find($event_id)->cur_capacity++;
        Attendee::create([
            "event_id" => $event_id,
            "user_id" => Auth::id()
        ]);

        return back();
    }

    public function unAttend(Request $request)
    {
        $id = $request->get('id');
        $attendee = Attendee
            ::where('event_id', '=', $id)
            ->where('user_id', '=', Auth::id())->first();
        try {
            if ($attendee != null) {
                Event::find($id)->cur_capacity--;
                $attendee->delete();
            }
        } catch (\Exception $e) {

        }
        return back();
    }

}
