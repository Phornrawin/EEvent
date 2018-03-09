<?php

use EEvent\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name' => 'AwesomeMax',
            'email' => 'criticalx7@gmail.com',
            'password' => Hash::make('max_awesome'),
        ));

        User::create(array(
            'name' => 'Peachio',
            'email' => 'peachyweed@gmail.com',
            'password' => Hash::make('peach_awesome'),
        ));

        User::create(array(
            'name' => 'NoSleep',
            'email' => 'criticalxinfinite@gmail.com',
            'password' => Hash::make('nosleep_awesome'),
        ));

        User::create(array(
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('testtest'),
        ));
    }
}