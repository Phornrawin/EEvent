<?php

namespace EEvent\Http\Controllers\Admin;

use EEvent\Event;
use EEvent\Http\Controllers\Controller;
use EEvent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Dompdf\Dompdf;
use Carbon\Carbon;


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
        $data = $request->validate(['name' => 'required', 'email' => 'required|email', 'password' => 'required|min:6']);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])]);
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
        $user = User::find($id);
        if ($user != null) {
            $user->update($request->all());

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
        $user = User::find($id);
        foreach ($user->attendEvent as $event) {
            $event->cur_capacity -=1;
            $event->save();
        }
        $user->delete();
        return $user;
    }

    public function show()
    {

    }

    public function getpdf()
    {

        $pdf = new Dompdf();
        $users = User::all();
        $records = "<h1 style='text-align: center'>EEvent users's report.</h1>";
        $records .= <<<'EOT'
<table class=\"table table-bordered table-striped\">
                        <tr>
                            <td>
                                <a href=\"#\" ng-click=\"sortType = 'name'; sortReverse = !sortReverse\">
                                    Name
                                    <span ng-show=\"sortType == 'name' && !sortReverse\"
                                          class=\"fa fa-caret-down\"></span>
                                    <span ng-show=\"sortType == 'name' && sortReverse\" class=\"fa fa-caret-up\"></span>
                                </a>
                            </td>
                            <td>
                                <a href=\"#\" ng-click=\"sortType = 'email'; sortReverse = !sortReverse\">
                                    Email
                                    <span ng-show=\"sortType == 'email' && !sortReverse\"
                                          class=\"fa fa-caret-down\"></span>
                                    <span ng-show=\"sortType == 'email' && sortReverse\"
                                          class=\"fa fa-caret-up\"></span>
                                </a>
                            </td>
                            <td>
                                <a href=\"#\" ng-click=\"sortType = 'avatar'; sortReverse = !sortReverse\">
                                    Avatar
                                    <span ng-show=\"sortType == 'avatar' && !sortReverse\"
                                          class=\"fa fa-caret-down\"></span>
                                    <span ng-show=\"sortType == 'avatar' && sortReverse\"
                                          class=\"fa fa-caret-up\"></span>
                                </a>
                            </td>
                        </tr>
EOT;
        foreach ($users as $user){
            $records.= <<<EOT
<tr><td>$user->name</td><td>$user->email</td><td>$user->avatar</td></tr>
EOT;
        }
        $records.="</table>";

        $pdf->loadHtml($records);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('users_report'.Carbon::now());

        return view('admin.users.index');
    }

}
