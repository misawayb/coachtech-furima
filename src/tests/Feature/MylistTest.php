<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use App\Models\Purchase;

class MylistTest extends TestCase
{
    use RefreshDatabase;

    public function test_5_1(): void
    {
        $user = User::factory()->create([
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
        $likeItems = Item::factory()->create(['name' => 'いいね商品']);
        $notLikeItems = Item::factory()->create(['name' => 'いいねなし商品']);
        Like::create([
            'user_id' => $user->id,
            'item_id' => $likeItems->id,
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('いいね商品');
        $response->assertDontSee('いいねなし商品');
    }

    public function test_5_2(): void
    {
        $buyer = User::factory()->create([
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
        $likeItem =Item::factory()->create([
            'name' => 'いいね商品'
        ]);
        Like::create([
            'user_id' => $buyer->id,
            'item_id' => $likeItem->id,
        ]);
        Purchase::create([
            'user_id' => $buyer->id,
            'item_id' => $likeItem->id,
            'zip_code' =>$buyer->zip_code,
            'address' => $buyer->address,
            'payment_method' => '支払いテスト'
        ]);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('Sold');
    }

    public function test_5_3(): void
    {
        $item = Item::factory()->create(['name' => 'テスト商品']);

        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertDontSee('テスト商品');
    }
}