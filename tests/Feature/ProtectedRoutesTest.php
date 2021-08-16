<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * Class ProtectedRoutesTest
 * Check all protected routes for an authenticated user
 * @package Tests\Feature
 */
class ProtectedRoutesTest extends TestCase
{
    /**
     * Test all the basic routes protected by session
     */
    public function testAll(): void
    {
        $user = User::factory()->create();
        $this->be($user);
        $response = $this->withSession(['user' => $user])
            ->get('/');
        $response->assertOk();
        $response = $this->withSession(['user' => $user])
            ->get('/articles');
        $response->assertOk();
        $response = $this->withSession(['user' => $user])
            ->get('/discussions');
        $response->assertOk();
        $response = $this->withSession(['user' => $user])
            ->get('/contact');
        $response->assertOk();
        $response = $this->withSession(['user' => $user])
            ->get('/paste');
        $response->assertOk();
        $response = $this->withSession(['user' => $user])
            ->get('/profile');
        $response->assertOk();
    }
}
