<?php

namespace EEvent\Http\Controllers;

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
        return view('events.index');
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
        Event::create($request);
        return back('success', 'Event has been added');
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
        $event->name = $request->get('name');
        $event->detail = $request->get('detail');
        $event->precondition = $request->get('request');
        $event->location = $request->get('location');
        $event->category = $request->get('category');
        $event->price = $request->get('price');
        $event->payment_time = $request->get('payment_time');
        $event->start_time = $request->get('start_time');
        $event->start_time = $request->get('end_time');
        $event->max_capacity = $request->get('max_capacity');
        $event->image_path = $request->get('image_path');
        $event->end_time = $request->get('end_time');
        $event->price = $request->get('price');
        $event->save();
        return redirect('events')->with('success', 'Product has been updated');
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
        return redirect('events')->with('success', 'Product has been  deleted');
    }

    public function search($query)
    {
        $events = Event::where("name", "LIKE", $query);
        return view(('events.search'), ['events' => $events]);
    }
}
