<?php

use EEvent\Profile;
use EEvent\User;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->delete();
        $users = User::all();
        foreach ($users as $user) {
            $user->profile()->create([
                'age' => random_int(18, 25),
                'tel_phone' => '0805556974'
            ]);
        }
    }
}
