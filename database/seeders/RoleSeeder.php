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
        // PESTAÑAS
        Permission::create(['name' => 'see.navigation.schedule.table', 'description' => 'This permission gates see the table of appointment'])->syncRoles([$role1, $role2, $role4]);
    }
}
