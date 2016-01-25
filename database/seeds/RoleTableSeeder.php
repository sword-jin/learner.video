<?php

use Learner\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Config::get('seeders.roles');

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'display_name' => $role['display_name'],
                'description' => $role['description']
            ]);
        }
    }
}
