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
            ['username' => 'user', 'email' => 'user@user.com', 'password' => '121212'],
            ['username' => 'admin', 'email' => 'admin@admin.com', 'password' => '121212'],
            ['username' => 'boss', 'email' => 'boss@boss.com', 'password' => '121212'],
        ];
        foreach($people as $index => $person) {
            $user = User::create([
                'username' => $person['username'],
                'email' => $person['email'],
                'password' => Hash::make($person['password']),
                'avatar' => AvatarManager::generateAvatar($person['username'])
            ]);

            $user->roles()->attach($index + 1);
        }
    }
}
