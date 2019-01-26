<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NavTest extends TestCase
{
    public function testWelcome()
    {
        $this->visit('/')
            ->see('App TLE');
    }

    public function testWelcomeToLogin()
    {
        $this->visit('/')
            ->click('Login')
            ->seePageIs('/login');
    }

    public function testWelcomeToRegister()
    {
        $this->visit('/')
            ->click('Register')
            ->seePageIs('/register');
    }

    public function testLogin()
    {
        $this->visit('/login')
            ->type('user1@gmail.com', 'email')
            ->type('User@1', 'password')
            ->press('Login')
            ->seePageIs('/home');
    }

    public function testRegister()
    {
        $password_rand = str_random(6);
        $this->visit('/register')
            ->type(str_random(5).' '.str_random(8), 'name')
            ->type(str_random(10).'@gmail.com', 'email')
            ->type($password_rand, 'password')
            ->type($password_rand, 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home');
    }
}
