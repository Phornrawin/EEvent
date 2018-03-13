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
            'detail' => 'Learn the ritual to summon a glorious web-tech software in limited time',
            'precondition' => 'Be able to withstand ton of bugs and bring your notebook =).',
            'location' => 'Kasetsart University Bangkok',
            'code' => bin2hex(openssl_random_pseudo_bytes(3)),
            'category_id' => 1, //adventure
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek(2)->subDay(),
            'start_time' => Carbon::now()->addWeek(2),
            'max_capacity' => 5,
        ));

        Event::create(array(
            'name' => 'Dance your heart out - Round one',
            'organizer_id' => 5,
            'detail' => 'Join us tonight at Kasetsart University for some crazy dancing move!!!',
            'precondition' => '',
            'location' => 'Kasetsart University Bangkok',
            'code' => bin2hex(openssl_random_pseudo_bytes(3)),
            'category_id' => 2, //dance
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek(5)->subDay(),
            'start_time' => Carbon::now()->addWeek(5),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'Enjoy the Varieties of delicious VEGAN food',
            'organizer_id' => 3,
            'detail' => 'Hi Dear members,
      
I am excited to announce our first meetup ever. Sorry for delay but I want to schedule it at very good place. Finally I found it. This Vegan bakery is located at Mercury mall (BTS Chidlom) on fourth floor. The name of the cafe is "Veganerie".

The Lady who owns this Vegan cafe is a Social activist and promoting Vegan food worldwide. She is an Amazing lady and she is a member of BIVA (BANGKOK INTERNATIONAL VEGETARIAN ALLIANCE). She cook in house because she dont trust any supplier for authentic vegan food.

We will gather at her cafe and enjoy all the delicious VEGAN food. She has so many food varieties which I never seen before in any other cafe.

We will also discuss little about the advantage of being vegan and talk about some simple rules to live healthy life.

The space is limited (Around 25) so please RSVP so that I\'ll keep a record of how many people are coming up.

FREE event. No need to pay anything.

Just enjoy the company of likely minded healthy people.',
            'precondition' => 'You don\' need to be a vegan to joined this event',
            'location' => 'BTS chidlom',
            'code' => bin2hex(openssl_random_pseudo_bytes(3)),
            'category_id' => 6, //food
            'price' => 20,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 12,
        ));

        Event::create(array(
            'name' => 'Documentary about a Zen Buddhist retreat in rural France',
            'organizer_id' => 4,
            'detail' => "
Filmed over three years, in their monastery in rural France and on the road in the USA, this visceral film is a meditation on a community grappling with existential questions and the everyday routine of monastic life. As the seasons come and go, the monastics' pursuit for a deeper connection to themselves and the world around them is amplified by insights from Thich Nhat Hanh's early journals, narrated by actor Benedict Cumberbatch.",
            'precondition' => '',
            'location' => 'Foreign Correspondents\' Club of Thailand',
            'code' => bin2hex(openssl_random_pseudo_bytes(3)),
            'category_id' => 5, // food
            'price' => 30,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 16,
        ));

        Event::create(array(
            'name' => 'Voter Registration Training Workshop',
            'organizer_id' => 1,
            'detail' => 'Learn how to conduct your next voter registration drive, participate in one of the League\'s events, or train your group for their outreach activities. Led by Diane Burrows, we\'ll be talking about the logistics of voter registration, and how to run your own drives.
The League of Women Voters of the City of New York is a nonpartisan organization whose purpose is to promote informed and active participation in government. The League neither supports nor opposes candidates or political parties. The League is supported by public-spirited individuals, businesses, and organizations.',
            'precondition' => 'Be a Good listener',
            'location' => 'Kasetsart University Bangkok',
            'code' => bin2hex(openssl_random_pseudo_bytes(3)),
            'category_id' => 3, //Movement
            'price' => 0,
            'payment_time' => Carbon::now()->addWeek()->subDay(),
            'start_time' => Carbon::now()->addWeek(),
            'max_capacity' => 32,
        ));
    }
}