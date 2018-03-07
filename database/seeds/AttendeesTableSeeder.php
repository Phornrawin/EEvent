<?php

use EEvent\Attendee;
use EEvent\Event;
use Illuminate\Database\Seeder;

class AttendeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendees')->delete();
        Attendee::create([
            'event_id' => 1,
            'user_id' => 2
        ]);

        Attendee::create([
            'event_id' => 1,
            'user_id' => 3
        ]);

        $event = Event::find(1);
        $event->cur_capacity = 2;
    }
}
