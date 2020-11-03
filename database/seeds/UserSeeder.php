<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name' => 'Admin',
               'email' => 'admin@test.com',
               'password' => '123456',
               'user_type' => 'admin',
               'company_id' => 1
            ],
            [
               'name' => 'Manager',
               'email' => 'manager@test.com',
               'password' => '123456',
               'user_type' => 'manager',
               'company_id' => 1
            ],
            [
               'name' => 'Employee',
               'email' => 'employee@test.com',
               'password' => '123456',
               'user_type' => 'employee',
               'company_id' => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
