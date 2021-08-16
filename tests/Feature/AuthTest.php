<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AuthTest
 * This class should be run once
 * Test for auth (signup and signin)
 * @package Tests\Feature
 */
class AuthTest extends TestCase
{
    use WithFaker;

    protected static string $password;
    protected static User $user;

    /**
     * If you want to run this test more than once, change this values
     * Init the password and the user objet
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$password = 'thisisAsecur3p@ssw0rD';
        self::$user = new User();
        self::$user->name = 'Test user';
        self::$user->email = 'getthis@getthistest.com';
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
            'name'      => self::$user->name,
            'email'     => self::$user->email,
            'password1' => self::$password,
            'password2' => self::$password
        ]);
        $response->assertRedirect('/')
            ->assertSessionHas('user');
    }

    /**
     * Test for normal login
     * And logout
     */
    public function testUserLogin(): void
    {
        $response = $this->post('signin', [
            'email'    => self::$user->email,
            'password' => self::$password
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
            'email'    => self::$user->email,
            'password' => self::$password . 'i'
        ]);
        $response->assertSessionHasErrors();
    }
}
