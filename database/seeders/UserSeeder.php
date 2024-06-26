<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersArray = config('users');
        foreach($usersArray as $eachUser) {
            $user1 = User::create([
                'name'     => $eachUser['name'],
                'email'    => $eachUser['email'],
                'password' => bcrypt($eachUser['password']),
            ]);
        }
    }
}
