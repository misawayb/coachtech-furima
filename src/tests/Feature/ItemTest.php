<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_4_1(): void
    {
        $item = Item::factory()->create(['name' => 'テスト商品']);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('テスト商品');
    }

    public function test_4_2(): void
    {
        $seller = User::factory()->create();
        $buyer = User::factory()->create([
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
        ]);
        $item = Item::factory()->create([
            'name' => 'テスト商品',
            'user_id' => $seller->id,]);
        Purchase::create([
            'user_id'        => $buyer->id,
            'item_id'        => $item->id,
            'zip_code'       => $buyer->zip_code,
            'address'        => $buyer->address,
            'payment_method' => '支払いテスト',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_4_3(): void
    {
        $seller = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);
        $soldItem = Item::factory()->create([
            'name' => 'テスト商品',
            'user_id' => $seller->id,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('テスト商品');
    }
}
