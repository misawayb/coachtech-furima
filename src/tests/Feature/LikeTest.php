<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_8_1(): void
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

        $response = $this->post('/item/' . $item->id . '/like');

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_8_2(): void
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

        $response = $this->post('/item/' . $item->id . '/like');
        $response = $this->get('/item/' . $item->id );

        $response->assertStatus(200);
        $response->assertSee('いいね済みハート');
    }

    public function test_8_3(): void
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

        $response = $this->post('/item/' . $item->id . '/like');
        $response = $this->get('/item/' . $item->id);
        $response = $this->post('/item/' . $item->id . '/like');
        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee('デフォルトハート');
    }

    public function test_8_4(): void
    {
        $item = Item::factory()->create();

        $response = $this->post('/item/' . $item->id . '/like');

        $response->assertRedirect('/login');
    }
}
