<?php

namespace EEvent\Http\Controllers\Admin;

use Carbon\Carbon;
use EEvent\Event;
use EEvent\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment_time = Carbon::now();
        $start_time = Carbon::now();
        Event::create(array(
            'name' => $request->get('name'),
            'organizer_id' => $request->get('organizer_id'),
            'detail' => $request->get('detail'),
            'precondition' => $request->get('precondition', ''),
            'location' => $request->get('location'),
            'code' => $request->get('code', bin2hex(openssl_random_pseudo_bytes(3))),
            'category_id' => $request->get('category_id'),
            'price' => $request->get('price'),
            'payment_time' => $payment_time,
            'start_time' => $start_time,
            'max_capacity' => $request->get('max_capacity'),
        ));
        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {   
        $event = Event::find($id);
        if ($event != null) {
            $event->update(array(
                'name' => $request->get('name'),
                'detail' => $request->get('detail'),
                'precondition' => $request->get('precondition', ''),
                'location' => $request->get('location'),
                'category_id' => $request->get('category_id'),
                'max_capacity' => $request->get('max_capacity'),
            ));
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();

        return response($event);
    }

    public function show()
    {

    }
}
