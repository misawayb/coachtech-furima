<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{

    use RefreshDatabase;

    public function test_3_1(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);

        $response = $this->post('/logout');

        $this->assertGuest();
    }
}
