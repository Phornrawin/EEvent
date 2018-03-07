<?php

use EEvent\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventsTableSeeder extends Seeder
{

    public function run()
    {
        $id = 1;
        DB::table('events')->delete();
        Event::create(array(
            'name' => 'Glorious Web-tech Ceremony',
            'organizer_id' => $id,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '123456',
            'category' => 'adventure',
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'end_time' => Carbon::now()->addWeek(),
            'cur_capacity' => 0,
            'max_capacity' => 64,
        ));
    }
}