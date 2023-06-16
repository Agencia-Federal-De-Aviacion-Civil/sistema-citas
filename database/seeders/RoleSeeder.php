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
        Permission::create(['name' => 'super_admin.see.tabs.navigation', 'description' => 'The super admin, could see the diferente systems'])->syncRoles([$role1]);
        Permission::create(['name' => 'super_admin.see.dashboard', 'description' => 'El super administrador puede ver el dashboard principal'])->syncRoles([$role1]);
        Permission::create(['name' => 'medicine_admin.see.tabs.navigation', 'description' => 'El administrador de medicina puede navegar por sus pestañas correspondientes'])->syncRoles([$role2]);
        Permission::create(['name' => 'medicine_admin.see.dashboard', 'description' => 'El administrador de medicina puede ver su dashboard'])->syncRoles([$role2]);
        Permission::create(['name' => 'super_admin.medicine_admin.see.schedule.table', 'description' => 'Este permiso permite filtrar la tabla de citas y tiene que aplicarse a super_admin y medicine_admin'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'see.schedule.tabs', 'description' => 'Este permiso es global y permite ver la pestaña de citas agendadas'])->syncRoles([$role1, $role2,$role4]);
        Permission::create(['name' => 'user.see.navigation', 'description' => 'Este permiso permite ver la pestaña para agendar una cita'])->syncRoles([$role4]);
        Permission::create(['name' => 'user.see.schedule.table', 'description' => 'Este permiso permite a los usuarios ver sus citas agendadas'])->syncRoles([$role4]);

        // Permission::create(['name' => 'see.navigation.controller.systems', 'description' => 'The super admin, could see the diferente systems'])->syncRoles([$role1]);
        // Permission::create(['name' => 'see.appointment.medicine', 'description' => 'The medicine admin could see history appoinment'])->syncRoles([$role2]);
        // Permission::create(['name' => 'see.navigation.medicine', 'description' => 'The medicine admin could see navigation options'])->syncRoles([$role2]);
        // Permission::create(['name' => 'generate.appointment', 'description' => 'The user will could appointment generate'])->syncRoles([$role4]);
        // // PESTAÑAS
        // Permission::create(['name' => 'see.navigation.schedule.table', 'description' => 'This permission gates see the table of appointment'])->syncRoles([$role1, $role2, $role4]);
    }
}
