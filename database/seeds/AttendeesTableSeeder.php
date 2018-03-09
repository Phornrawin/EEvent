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
        $this->seedEvent(1, 2);
        $this->seedEvent(1, 3);
    }

    private function seedEvent($event_id, $user_id)
    {
        Attendee::create([
            'event_id' => $event_id,
            'user_id' => $user_id
        ]);
        $event = Event::find($event_id);
        $event->cur_capacity += 1;
    }
}
