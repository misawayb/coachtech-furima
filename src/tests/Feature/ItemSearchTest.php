<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class ItemSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_6_1(): void
    {
        $item = Item::factory()->create(['name' => 'テスト商品']);

        $response = $this->get('/?keyword=テスト');

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
    }

    public function test_6_2(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $item = Item::factory()->create(['name' => 'テスト商品']);

        $response = $this->get('/?tab=mylist&keyword=テスト');

        $response->assertStatus(200);
        $response->assertSee('テスト');
    }
}
