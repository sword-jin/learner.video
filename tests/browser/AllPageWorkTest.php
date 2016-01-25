<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AllPageWorkTest extends TestCase
{
    public function test_home_page_work()
    {
        $this->visit('/')
             ->assertResponseOk();
    }

    public function test_can_click_login_btn_redirect_to_login_page()
    {
        $this->visit('/')
             ->click('登陆')
             ->seePageIs('/login');
    }

    public function test_can_click_register_btn_redirect_to_register_page()
    {
        $this->visit('/')
            ->click('注册')
            ->seePageIs('/register');
    }
}
