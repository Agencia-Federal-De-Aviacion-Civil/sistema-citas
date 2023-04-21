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
        User::create(
            [
                'name' => 'Veronica Hernández Orozco',
                'email' => 'veronica.hernandezo@afac.gob.mx',
                'password' => bcrypt('12345678')
            ]
        )->assignRole('medicine_admin');
        User::create(
            [
                'name' => 'Julieta Meza Robles',
                'email' => 'berilio19@gmail.com',
                'password' => bcrypt('12345678')
            ]
        )->assignRole('medicine_admin');
        User::create(
            [
                'name' => 'Edgar Elif Rivas Pelay',
                'email' => 'edgar.rivas@afac.gob.mx',
                'password' => bcrypt('12345678')
            ]
        )->assignRole('medicine_admin');
        User::create(
            [
                'name' => 'Lezlie Jazmín Hernandez Noyola',
                'email' => 'lezlie.hernandez@afac.gob.mx',
                'password' => bcrypt('12345678')
            ]
        )->assignRole('medicine_admin');
        // User::create(
        //      [
        //          'name' => 'Cancun Quintana Roo',
        //          'email' => 'cancun@gmail.com',
        //          'password' => bcrypt('12345678')
        //      ]
        // )->assignRole('headquarters');
    }
}
