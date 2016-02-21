<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = [
            [
                'username'   => 'riddles',
                'password'   => bcrypt('test'),
                'firstName'  => 'Brandon',
                'lastName'   => 'Hyde',
                'email'      => 'riddles@dev-toolbox.com',
                'timezone'   => 'US/Central',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'Stygian',
                'password'   => bcrypt('test'),
                'firstName'  => 'Travis',
                'lastName'   => 'Blasingame',
                'email'      => 'stygian.warlock.v2@gmail.com',
                'timezone'   => 'US/Central',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }
}