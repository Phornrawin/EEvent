<?php

use Carbon\Carbon;
use EEvent\Attendee;
use EEvent\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $attendees = Attendee::all();
       foreach ($attendees as $attendee) {
           $attendee->payment()->create();
       }
    }
}
