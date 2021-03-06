<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'wagagt',
                'email'          => 'wagagt@admin.com',
                'password'       => bcrypt('wagapass'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'tienda1',
                'email'          => 'tienda1@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
