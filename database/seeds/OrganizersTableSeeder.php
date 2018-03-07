<?php

use EEvent\Organizer;
use Illuminate\Database\Seeder;

class OrganizersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendees')->delete();
        Organizer::create([
            'event_id' => 1,
            'user_id' => 1
        ]);
    }
}
