<?php

use Carbon\Carbon;
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
        Payment::create([
            'attendee_id' => 1,
            'payment_time' => Carbon::now()->addDay(5)
        ]);
    }
}
