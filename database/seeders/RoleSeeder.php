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
        Permission::create(['name' => 'afac.home', 'description' => 'See dashboard'])->syncRoles([$role1, $role2]);
        // Permission::create(['name' => 'afac.home.catalogue', 'description' => 'See menu options catalogue'])->syncRoles([$role1]);
    }
}
