<?php

namespace EEvent\Http\Controllers\Admin;

use Carbon\Carbon;
use EEvent\Event;
use EEvent\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;

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

        $payment_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('payment_time'));
        $start_time = Carbon::createFromFormat('Y-m-d\TH:i', $request->get('start_time'));

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
             if (isset($request['image_path'])) {
                $this->validate($request, [
                    'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $imageName = time() . '.' . $request->image_path->getClientOriginalExtension();
                $request->image_path->move(public_path('uploads/events_pic'), $imageName);
                $data += array('image_path' => $imageName);
            }
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
    public function getpdf()
    {

        $pdf = new Dompdf();
        $events = Event::all();
        $records = "<h1 style='text-align: center'>EEvent events's report.</h1>";
        $records .= <<<'EOT'
<table class="table table-bordered table-striped">
                        <tr>
                            <td>
                                <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                                    ID
                                    <span ng-show="sortType == 'name' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'email'; sortReverse = !sortReverse">
                                    Name
                                    <span ng-show="sortType == 'email' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'email' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'precondition'; sortReverse = !sortReverse">
                                    Precondition
                                    <span ng-show="sortType == 'precondition' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'precondition' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'location'; sortReverse = !sortReverse">
                                    Location
                                    <span ng-show="sortType == 'location' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'location' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'code'; sortReverse = !sortReverse">
                                    Code
                                    <span ng-show="sortType == 'code' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'code' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'price'; sortReverse = !sortReverse">
                                    Price
                                    <span ng-show="sortType == 'price' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'price' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'payment_time'; sortReverse = !sortReverse">
                                    Payment_time
                                    <span ng-show="sortType == 'payment_time' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'payment_time' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'start_time'; sortReverse = !sortReverse">
                                    Start_time
                                    <span ng-show="sortType == 'start_time' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'start_time' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'cur_capacity'; sortReverse = !sortReverse">
                                    Cur_capacity
                                    <span ng-show="sortType == 'cur_capacity' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'cur_capacity' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'max_capacity'; sortReverse = !sortReverse">
                                    Max_capacity
                                    <span ng-show="sortType == 'max_capacity' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'max_capacity' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = 'created_at'; sortReverse = !sortReverse">
                                    Created_at
                                    <span ng-show="sortType == 'created_at' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'created_at' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                            <td>
                                <a href="#" ng-click="sortType = ' updated_at'; sortReverse = !sortReverse">
                                    Updated_at
                                    <span ng-show="sortType == 'updated_at' && !sortReverse"
                                          class="fa fa-caret-down"></span>
                                    <span ng-show="sortType == 'updated_at' && sortReverse"
                                          class="fa fa-caret-up"></span>
                                </a>
                            </td>
                        </tr>
EOT;
        foreach ($events as $event){
            $records.= <<<"EOT"
<tr ng-repeat="event in events | orderBy:sortType:sortReverse | filter:searchName">
                            <td>$event->id</td>
                            <td>$event->name</td>
                            <td>$event->precondition</td>
                            <td>$event->location</td>
                            <td>$event->code</td>
                            <td>$event->price</td>
                            <td>$event->payment_time</td>
                            <td>$event->start_time</td>
                            <td>$event->cur_capacity</td>
                            <td>$event->max_capacity</td>
                            <td>$event->created_at</td>
                            <td>$event->updated_at</td>
                        </tr>
EOT;
        }
        $records.="</table>";

        $pdf->loadHtml($records);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $pdf->stream('events_report'.Carbon::now());

        return view('admin.events.index');
    }

}
