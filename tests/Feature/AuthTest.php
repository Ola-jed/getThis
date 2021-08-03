<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * Class AuthTest
 * This class should be run once
 * Test for auth (signup and signin)
 * @package Tests\Feature
 */
class AuthTest extends TestCase
{
    protected string $password;
    protected User $user;

    /**
     * Flush the user table
     * Init the password and the user objet
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->password = 'thisisAsecur3p@ssw0rD';
        $this->user = new User();
        $this->user->name = 'Test user';
        $this->user->email = 'getthis@getthistest.com';
    }

    /**
     * Test that all auth routes returns http 200
     */
    public function testOkForAuthRoutes(): void
    {
        $response = $this->get('/signup');
        $response->assertOk();
        $response = $this->get('/signin');
        $response->assertOk();
        $response = $this->get('/forget-password');
        $response->assertOk();
    }

    /**
     * Test for register
     */
    public function testUserRegister(): void
    {
        $response = $this->post('signup', [
            'name'      => $this->user->name,
            'email'     => $this->user->email,
            'password1' => $this->password,
            'password2' => $this->password
        ]);
        $response->assertRedirect('/')
            ->assertSessionHas('user');
    }

    /**
     * Test for normal login
     */
    public function testUserLogin(): void
    {
        $response = $this->post('signin', [
            'email'    => $this->user->email,
            'password' => $this->password
        ]);
        $response->assertRedirect('/')
            ->assertSessionHas('user');
    }

    /**
     * Testing invalid logins for our user
     */
    public function testInvalidLogins(): void
    {
        $response = $this->post('signin', [
            'email'    => $this->user->email,
            'password' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
    }
}
