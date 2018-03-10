<?php

use EEvent\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('events')->delete();
        Event::create(array(
            'name' => 'Glorious Web-tech Ceremony',
            'organizer_id' => 1,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '123456',
            'category_id' => 1, //adventure
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek(2)->subDay(),
            'start_time' => Carbon::now()->addWeek(2),
            'max_capacity' => 5,
        ));

        Event::create(array(
            'name' => 'Test web-tech ceremony',
            'organizer_id' => 1,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '111111',
            'category_id' => 1, //adventure
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek(5)->subDay(),
            'start_time' => Carbon::now()->addWeek(5),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'test1',
            'organizer_id' => 2,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '222222',
            'category_id' => 2, //Dance
            'price' => 999,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'test2',
            'organizer_id' => 2,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '333333',
            'category_id' => 2, //Dance
            'price' => 500,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 30,
        ));

        Event::create(array(
            'name' => 'test3',
            'organizer_id' => 3,
            'detail' => 'The ritual to summon the glorious web-tech demon in 7 days',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '444444',
            'category_id' => 6, //Other
            'price' => 199,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 64,
        ));
    }
}