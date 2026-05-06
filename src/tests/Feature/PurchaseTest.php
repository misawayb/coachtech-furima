<?php

namespace Tests\Feature;

use App\Enums\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_10_1(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);
        $item = Item::factory()->create();

        $response = $this->get('/');
        $response = $this->get('/purchase/' . $item->id);
        $response = $this->post('/purchase/' . $item->id, [
            'zip_code' => $user->zip_code,
            'address'  => $user->address,
            'payment_method' => PaymentMethod::CreditCard->value,
        ]);

        $response->assertRedirect();
    }

    public function test_10_2(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'zip_code'       => '123-4567',
            'address'        => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);
        $item = Item::factory()->create();

        $response = $this->get('/');
        $response = $this->get('/purchase/' . $item->id);
        session(['purchase_data' => [
            'user_id'   => $user->id,
            'item_id'   => $item->id,
            'zip_code'  => $user->zip_code,
            'address'   => $user->address,
            'payment_method' => PaymentMethod::CreditCard->value,
        ]]);
        $response = $this->get('/purchase/success/' . $item->id);
        $response = $this->get('/');

        $response->assertSee('Sold');
    }

    public function test_10_3(): void
    {
        $user = User::factory()->create([
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'zip_code'       => '123-4567',
            'address'        => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);
        $item = Item::factory()->create();

        $response = $this->get('/');
        $response = $this->get('/purchase/' . $item->id);
        session(['purchase_data' => [
            'user_id'   => $user->id,
            'item_id'   => $item->id,
            'zip_code'  => $user->zip_code,
            'address'   => $user->address,
            'payment_method' => PaymentMethod::CreditCard->value,
        ]]);
        $response = $this->get('/purchase/success/' . $item->id);
        $response = $this->get('/mypage?page=buy');

        $response->assertSee($item->name);
    }

    public function test_11_1(): void
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

        $response = $this->post('/purchase/' . $item->id . '/payment',[
            'payment_method' => PaymentMethod::ConvenienceStore
        ]);

        $response->assertSee('コンビニ支払い');
    }

    public function test_12_1(): void
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

        $response = $this->post('/purchase/address/' . $item->id, [
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'building'  => 'テストビル1F',
        ]);
        $response = $this->get('/purchase/' . $item->id );

        $response->assertSee([
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'building'  => 'テストビル1F',
        ]);
    }

    public function test_12_2(): void
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
        $soldItem = Item::factory()->create();

        session(['purchase_data' =>[
            'user_id'   => $user->id,
            'item_id'   => $soldItem->id,
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'building'  => 'テストビル1F',
            'payment_method' => PaymentMethod::CreditCard->value,
        ]]);
        $response = $this->get('/purchase/success/' . $soldItem->id );

        $response = $this->assertDatabaseHas('purchases',[
            'user_id'   => $user->id,
            'item_id'   => $soldItem->id,
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'building'  => 'テストビル1F',
            'payment_method' => 'カード支払い',
        ]);
    }
}
