<?php

class AuthControllerTest extends TestCase
{
    public function test_not_fill_form_show_error_message_when_register()
    {
        $this->visit('/auth/register')
             ->press('注册')
             ->seePageIs('/auth/register')
             ->see('用户名 不能为空。')
             ->see('邮箱 不能为空。')
             ->see("密码 不能为空。");
    }

    public function test_fill_twice_different_password_when_register()
    {
        $this->visit('/auth/register')
             ->type('121212', 'password')
             ->type('212121', 'password_confirmation')
             ->press('注册')
             ->see("密码 两次输入不一致。");
    }

    public function test_fill_a_forbidden_username_when_register($value='')
    {
        $this->addValidator();

        $this->visit('/auth/register')
             ->type('user', 'username')
             ->press('注册')
             ->see("用户名起的太叼，系统无法识别");
    }
}
