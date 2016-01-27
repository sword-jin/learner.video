<?php

use Learner\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCanNotAccessAdminTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->seed('RoleTableSeeder');
        $this->seed('UserTableSeeder');
    }

    public function test_admin_is_secret()
    {
        $response = $this->call('GET', URL::to('/admin/'));

        $this->assertEquals('302', $response->getStatusCode());
    }

    public function test_general_user_can_access_admin()
    {
        $user = $this->createAGeneralUser();

        $this->be($user);

        $response = $this->call('GET', URL::to('/admin/'));

        $this->assertEquals('302', $response->getStatusCode());
    }

    public function test_a_admin_can_access_admin()
    {
        $admin = User::find(2);

        $this->be($admin);

        $response = $this->call('GET', URL::to('/admin/'));

        $this->assertEquals('200', $response->getStatusCode());
    }

    public function test_a_boss_can_access_admin()
    {
        $admin = User::find(3);

        $this->be($admin);

        $response = $this->call('GET', URL::to('/admin/'));

        $this->assertEquals('200', $response->getStatusCode());
    }
}
