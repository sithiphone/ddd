<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new \App\Role();
        $role_user->name = 'Member';
        $role_user->description = 'A normal user';
        $role_user->save();

        $role_admin = new \App\Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'A admin user';
        $role_admin->save();

        $role_super_admin = new \App\Role();
        $role_super_admin->name = 'Super_admin';
        $role_super_admin->description = 'A super admin user';
        $role_super_admin->save();
    }
}
