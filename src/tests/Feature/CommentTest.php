<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_9_1(): void
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
        $item = Item::factory()->create();

        $response = $this->post('/item/' . $item->id . '/comment',[
            'comment' => 'テストコメント',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'テストコメント',
        ]);
    }

    public function test_9_2(): void
    {
        $item = Item::factory()->create();

        $response = $this->post('/item/' . $item->id . '/comment', [
            'comment' => 'テストコメント',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_9_3(): void
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
        $item = Item::factory()->create();

        $response = $this->post('/item/' . $item->id . '/comment', [
            'comment' => '',
        ]);

        $response->assertSessionHasErrors(['comment' => 'コメントを入力してください']);
    }

    public function test_9_4(): void
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
        $item = Item::factory()->create();

        $response = $this->post('/item/' . $item->id . '/comment', [
            'comment' => str_repeat('a', 256),
        ]);

        $response->assertSessionHasErrors(['comment' => '255文字以下で入力してください']);
    }
}
