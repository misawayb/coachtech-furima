<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function test_2_1(): void
    {
        $response = $this->post('/login',[
            'email'     => '',
            'password'  => 'password123'
        ]);

        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function test_2_2(): void
    {
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => ''
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    public function test_2_3(): void
    {
        $response = $this->post('/login', [
            'email'     => 'notexist@example.com',
            'password'  => 'password123',
        ]);

        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません']);
    }

    public function test_2_4(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);

        $response->assertRedirect(route('user.index'));
    }
}
