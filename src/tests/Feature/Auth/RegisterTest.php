<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_1_1(): void
    {
        $response = $this->post('/register', [
            'name'                  => '',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['name' => 'お名前を入力してください']);
    }

    public function test_1_2(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'test',
            'email'                 => '',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    }

    public function test_1_3(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'test',
            'email'                 => 'test@example.com',
            'password'              => '',
            'password_confirmation' => 'password123',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    public function test_1_4(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'test',
            'email'                 => 'test@example.com',
            'password'              => 'pass',
            'password_confirmation' => 'pass',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
    }

    public function test_1_5(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'test',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password1234',
        ]);

        $response->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
    }

    public function test_1_6(): void
    {
        $response = $this->post('/register', [
            'name'                  => 'test',
            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('users', [
            'name'  => 'test',
            'email' => 'test@example.com',
        ]);
    }
}
