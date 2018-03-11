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
            'name' => 'Dance your heart out - Round 1',
            'organizer_id' => 1,
            'detail' => 'Join us to night at Kasetsart University for some crazy dancing move',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '111111',
            'category_id' => 2, //dance
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek(5)->subDay(),
            'start_time' => Carbon::now()->addWeek(5),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'Dance Master - Epic Showdown',
            'organizer_id' => 2,
            'detail' => 'Dance showdown of the year tonight at Kasetsart',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '222222',
            'category_id' => 2, //dance
            'price' => 999,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'How to be a true Vegan',
            'organizer_id' => 2,
            'detail' => 'Learn how to be a vegan, you will learn anything about how to be a True vegan',
            'precondition' => 'No life and No friend',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '333333',
            'category_id' => 4, // food
            'price' => 500,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 30,
        ));

        Event::create(array(
            'name' => 'Voter Registration Training Workshop',
            'organizer_id' => 3,
            'detail' => 'Learn how to conduct your next voter registration drive, participate in one of the League\'s events, or train your group for their outreach activities. Led by Diane Burrows, we\'ll be talking about the logistics of voter registration, and how to run your own drives.
The League of Women Voters of the City of New York is a nonpartisan organization whose purpose is to promote informed and active participation in government. The League neither supports nor opposes candidates or political parties. The League is supported by public-spirited individuals, businesses, and organizations.',
            'precondition' => 'Be a Good listener',
            'location' => 'SCU-45 Kasetsart University Bangkok',
            'code' => '444444',
            'category_id' => 3, //Movement
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 64,
        ));
    }
}