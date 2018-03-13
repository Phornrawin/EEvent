<?php

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
        $this->seedEvent(1, [2, 3, 4, 5]);
        $this->seedEvent(4, [1, 6, 3]);

        $event = Event::find(4);
        $attendee1 = $event->attendees()->create(['user_id' => 2, 'accept' => true]);
        if ($event->price > 0) {
            $attendee1->payment()->create();
        }
        $attendee2 = $event->attendees()->create(['user_id' => 5, 'accept' => true]);
        if ($event->price > 0) {
            $attendee2->payment()->create();
        }

        $max = \EEvent\Attendee::find(5);
        $max->check_in = true;
        $max->save();

    }

    private function seedEvent($event_id, $user_id = [])
    {
        $event = Event::find($event_id);
        foreach ($user_id as $id) {
            $attendee = $event->attendees()->create(['user_id' => $id]);
            if ($event->price > 0) {
                $attendee->payment()->create();
            }
        }

        $event->cur_capacity += count($user_id);
        $event->save();
    }


}
