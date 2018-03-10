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
            'password' => Hash::make('maxmax'),
        ));

        User::create(array(
            'name' => 'Peachio',
            'email' => 'peachyweed@gmail.com',
            'password' => Hash::make('peachpeach'),
        ));

        User::create(array(
            'name' => 'NoSleep',
            'email' => 'criticalxinfinite@gmail.com',
            'password' => Hash::make('nosleepnosleep'),
        ));



        User::create(array(
            'name' => 'Adam',
            'email' => 'adamawesome@gmail.com',
            'password' => Hash::make('adamadam'),
        ));

        User::create(array(
            'name' => 'Jessica',
            'email' => 'jessicaawesome@gmail.com',
            'password' => Hash::make('jessicajessica'),
        ));

        User::create(array(
            'name' => 'Albert',
            'email' => 'albertawesome@gmail.com',
            'password' => Hash::make('albertawesome'),
        ));

        User::create(array(
            'name' => 'Zack',
            'email' => 'zackawesome@gmail.com',
            'password' => Hash::make('zackawesome'),
        ));

        User::create(array(
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('testtest'),
        ));
    }
}