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
            'Avatar' => 'NoSleep.jpg'
        ));

        User::create(array(
            'name' => 'Adam',
            'email' => 'adamawesome@gmail.com',
            'password' => Hash::make('adamadam'),
            'avatar' => 'Adam.png'
        ));

        User::create(array(
            'name' => 'Jessica',
            'email' => 'jessicaawesome@gmail.com',
            'password' => Hash::make('jessicajessica'),
            'avatar' => 'Jessica.png'
        ));

        User::create(array(
            'name' => 'Jeddo',
            'email' => 'albertawesome@gmail.com',
            'password' => Hash::make('albertalbert'),
            'avatar' => 'Jeddo.jpg'
        ));


        User::create(array(
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('testtest'),
            'role' => 'admin'
        ));
    }
}