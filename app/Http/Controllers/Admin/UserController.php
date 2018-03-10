<?php

namespace EEvent\Http\Controllers\Admin;

use Auth;
use EEvent\Event;
use EEvent\Http\Controllers\Controller;
use EEvent\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $events = Event::all();
        return view('admin.users.index', ['users' => $users, 'events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
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
        $user = User::find($id);
        return view('admin.users.edit', ['user' => $user]);
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
        $event = User::find($id);
        if ($event != null) {
            $event->update($request->all());

        }
        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $temp = Auth::user();
        $user = User::find($id);
        Auth::setUser($user);
        Auth::logout();
        Auth::login($temp);

        try {
            $user->delete();
        } catch (\Exception $e) {
        }
        return redirect()->route('admin.users.index');
    }

    public function show()
    {

    }


}
