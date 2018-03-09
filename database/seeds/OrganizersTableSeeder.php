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
        DB::table('organizers')->delete();

        Organizer::create([
            'event_id' => 1,
            'user_id' => 1
        ]);

        Organizer::create([
            'event_id' => 2,
            'user_id' => 1
        ]);

        Organizer::create([
            'event_id' => 3,
            'user_id' => 1
        ]);

        Organizer::create([
            'event_id' => 4,
            'user_id' => 2
        ]);

        Organizer::create([
            'event_id' => 5,
            'user_id' => 3
        ]);
    }
}
