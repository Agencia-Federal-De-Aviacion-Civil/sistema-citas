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
                'apParental' => 'admin',
                'apMaternal' => 'admin',
                'genre' => 'xx',
                'birth' => 'xxx',
                'state_id' => '1',
                'municipal_id' => '1',
                'age' => 'xx',
                'street' => 'xx',
                'nInterior' => 'xx',
                'nExterior' => 'xx',
                'suburb' => 'xxxx',
                'postalCode' => 'xx',
                'federalEntity' => 'xx',
                'delegation' => 'xx',
                'mobilePhone' => 'xx',
                'officePhone' => 'xx',
                'extension' => 'xx',
                'curp' => '123456789',
                'email' => 'admin@afac.gob.mx',
                'password' => bcrypt('12345678')
            ]
        );
    }
}
