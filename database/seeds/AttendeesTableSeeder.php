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
        $this->seedEvent(1, [2, 3, 4, 5]);

    }

    private function seedEvent($event_id, $user_id = [])
    {
        $event = Event::find($event_id);
        foreach ($user_id as $id) {
            $event->attendees()->create(['user_id' => $id]);
        }
        $event->cur_capacity += count($user_id);
        $event->save();
    }
}
