<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

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
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin'),
                'role' => 1,
                'phone' => '089999999999',
            ],
            [
                'name' => 'customer',
                'email' => 'customer@mail.com',
                'password' => Hash::make('customer'),
                'role' => 2,
                'phone' => '089999999999'
            ],
        ];

        foreach ($user as $users => $value) {
            User::create($value);
        }
    }
}
