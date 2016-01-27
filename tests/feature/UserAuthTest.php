<?php

use Learner\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        $this->seed('RoleTableSeeder');
    }

    public function test_can_register_success()
    {
        $this->addValidator();

        $this->post('/auth/register', [
            'username' => 'learner',
            'email'    => 'foo@bar.com',
            'password' => '121212',
            'password_confirmation' => '121212'
        ]);

        $user = User::find(1);
        $this->assertEquals($user->email, 'foo@bar.com');
        $this->assertTrue(Hash::check('121212', $user->password));
    }

    public function test_can_login_success_by_email_or_username()
    {
        $createdUser = $this->createAGeneralUser();

        $this->post('/auth/login', [
            'credential' => 'learner',
            'password' => '121212',
        ]);

        $this->seeStatusCode(302);

        $this->post('/auth/login', [
            'credential' => 'foo@bar.com',
            'password' => '121212',
        ]);

        $this->seeStatusCode(302);
    }

    protected function createAGeneralUser()
    {
        return factory(Learner\Models\User::class)->create([
            'username' => 'learner',
            'email'    => 'foo@bar.com',
            'password' => Hash::make('121212'),
        ]);
    }
}
