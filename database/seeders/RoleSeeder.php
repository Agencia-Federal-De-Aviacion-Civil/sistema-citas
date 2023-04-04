<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'super_admin']);
        $role2 = Role::create(['name' => 'medicine_admin']);
        $role3 = Role::create(['name' => 'linguistic_admin']);
        $role4 = Role::create(['name' => 'user']);
        $role3 = Role::create(['name' => 'headquarters']);
        Permission::create(['name' => 'see.navigation.controller.systems', 'description' => 'The super admin, could see the diferente systems'])->syncRoles([$role1]);
        Permission::create(['name' => 'see.appointment.medicine', 'description' => 'The medicine admin could see history appoinment'])->syncRoles([$role2]);
        Permission::create(['name' => 'see.navigation.medicine', 'description' => 'The medicine admin could see navigation options'])->syncRoles([$role2]);
        Permission::create(['name' => 'generate.appointment', 'description' => 'The user will could appointment generate'])->syncRoles([$role4]);
        // Permission::create(['name' => 'navigation.see.notifications', 'description' => 'This permission is to see the notifications'])->syncRoles([$role3]);
        // Permission::create(['name' => 'see.appointments', 'description' => 'The Admins and Headquarters will could appoinments'])->syncRoles([$role1, $role3]);
        // Permission::create(['name' => 'admin.see.headquarters', 'description' => 'See headquarters appointments'])->syncRoles([$role1]);
        // Permission::create(['name' => 'afac.home.catalogue', 'description' => 'See menu options catalogue'])->syncRoles([$role1]);
    }
}
