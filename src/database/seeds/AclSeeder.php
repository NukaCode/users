<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder {

    public function run()
    {
        $this->insertPermissions();
        $this->insertRoles();
        $this->linkRolesAndPermissions();
    }

    private function insertPermissions()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = config('nukacode-user.permissions');

        // Add any data to the table.
        DB::table('permissions')->insert($permissions);
    }

    private function insertRoles()
    {

        // Uncomment the below to wipe the table clean before populating
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // These are set in the config so the individual site can override the defaults when desired.
        $roles = config('nukacode-user.roles');

        // Uncomment the below to run the seeder
        DB::table('roles')->insert($roles);
    }

    private function linkRolesAndPermissions()
    {
        // Truncate the table each time.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permission_role')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = config('nukacode-user.permission_role');

        // Add any data to the table.
        DB::table('permission_role')->insert($permissions);
    }
}