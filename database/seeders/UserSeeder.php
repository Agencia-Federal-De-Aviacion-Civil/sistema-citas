<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@afac.gob.mx',
                'password' => bcrypt('12345678')
            ]
        )->assignRole('super_admin');
        // User::create(
        //     [
        //         'name' => 'Cancun Quintana Roo',
        //         'email' => 'cancun@gmail.com',
        //         'password' => bcrypt('12345678')
        //     ]
        // )->assignRole('headquarters');
    }
}
