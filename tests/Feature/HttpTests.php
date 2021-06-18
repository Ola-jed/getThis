<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpTests extends TestCase
{
    /**
     * Test if you're redirected when you get the index url
     *
     * @return void
     */
    public function test_home()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function test_get_login_and_register(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_post_register(): void
    {
        $response = $this->post('/register',[
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password1' => '0000',
            'password2' => '0000'
        ]);
        dd($response);
    }

}
