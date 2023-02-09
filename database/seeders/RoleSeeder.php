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
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        Permission::create(['name' => 'admin.see.history', 'description' => 'See history appointments'])->syncRoles([$role1]);
        // Permission::create(['name' => 'afac.home.catalogue', 'description' => 'See menu options catalogue'])->syncRoles([$role1]);
    }
}
