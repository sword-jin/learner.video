<?php

class AuthControllerTest extends TestCase
{
    public function test_not_fill_form_show_error_message()
    {
        $this->visit('/register')
             ->press('注册')
             ->seePageIs('/register')
             ->see('用户名 不能为空。')
             ->see('邮箱 不能为空。')
             ->see("密码 不能为空。");
    }

    public function test_fill_twice_different_password()
    {
        $this->visit('/register')
             ->type('121212', 'password')
             ->type('212121', 'password_confirmation')
             ->press('注册')
             ->see("密码 两次输入不一致。");
    }
}
