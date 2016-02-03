<?php

use Learner\Models\User;
use Learner\Facades\Manager;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [
            'username' => 'boss',
            'email' => 'boss@boss.com',
            'password' => '121212'
        ];

        $user = User::create([
            'username' => $people['username'],
            'email' => $people['email'],
            'password' => Hash::make($people['password']),
            'avatar' => AvatarManager::generateAvatar($people['username'])
        ]);

        $user->roles()->attach(3);
    }
}
