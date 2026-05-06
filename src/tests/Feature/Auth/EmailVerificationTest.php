<?php

namespace Tests\Feature\Auth;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Models\User;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_16_1(): void
    {
        Notification::fake();
        $response = $this->post('/register', [
            'name'                  => 'テストユーザー',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $user = User::where('email', 'test@example.com')->first();

        Notification::assertSentTo($user, VerifyEmail::class);
    }

    public function test_16_2(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'テストユーザー',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response = $this->get('/email/verify');

        $response->assertSee('認証はこちらから');
    }

    public function test_16_3(): void
    {
        Notification::fake();
        $response = $this->post('/register', [
            'name'                  => 'テストユーザー',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123'
        ]);
        $user = User::where('email', 'test@example.com')->first();

        Notification::assertSentTo($user, VerifyEmail::class, function ($notification) use ($user) {
            $url = $notification->toMail($user)->actionUrl;

            $response= $this->get($url);
            $response->assertRedirect(route('user.index') .'?verified=' . $user->id);

            return true;
        });
    }
}
