<?php

use Illuminate\Database\Seeder;

class NukaCodeUserSeeder extends Seeder
{

    public function run()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = config('nukacode-user.users');

        // Add any data to the table.
        DB::table('users')->insert($users);
    }
}
