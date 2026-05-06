<?php

namespace Tests\Feature;

use App\Enums\Condition;
use App\Enums\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Database\Seeders\CategorySeeder;


class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(CategorySeeder::class);
    }

    public function test_13_1(): void
    {
        $user = User::factory()->create([
            'name'      => 'テストユーザー',
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'profile_image' => 'image/test.jpg',
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);
        $soldItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => '出品した商品',
        ]);
        $boughtItem = Item::factory()->create([
            'name' => '購入した商品',
        ]);
        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $boughtItem->id,
            'zip_code' => $user->zip_code,
            'address' => $user->address,
            'building' => $user->building,
            'payment_method' => PaymentMethod::ConvenienceStore->value,
        ]);

        // プロフィール画像とユーザー名
        $response = $this->get('/mypage');
        $response->assertSee(['テストユーザー','image/test.jpg',]);

        // 出品した商品一覧
        $response = $this->get('/mypage?page=sell');
        $response->assertSee('出品した商品');

        // 購入した商品一覧
        $response = $this->get('/mypage?page=buy');
        $response->assertSee('購入した商品');
    }

    public function test_14_1(): void
    {
        $user = User::factory()->create([
            'name'      => 'テストユーザー',
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'profile_image' => 'image/test.jpg',
            'zip_code'  => '123-4567',
            'address'   => 'テスト住所',
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);

        $response = $this->get('mypage/profile');

        $response->assertSee(['image/test.jpg', 'テストユーザー', '123-4567', 'テスト住所']);
    }

    public function test_15_1(): void
    {
        $user = User::factory()->create([
            'name'      => 'テストユーザー',
            'email'     => 'test@example.com',
            'password'  => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);
        $response = $this->post('/login', [
            'email'     => 'test@example.com',
            'password'  => 'password123',
        ]);

        $this->get('sell');
        Storage::fake('public');
        $response =$this->post('sell',[
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'price' => '150',
            'category' => ['9','13'],
            'brand' => 'テストブランド',
            'description' => 'テスト商品の説明',
            'sell_image' => UploadedFile::fake()->create('test.png', 100, 'image/png'),
            'condition' => Condition::SlightScratches->value,
        ]);
        $item = Item::latest()->first();

        $this->assertDatabaseHas('items',[
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'price' => '150',
            'brand' => 'テストブランド',
            'description' => 'テスト商品の説明',
            'condition' => 'やや傷や汚れあり',
        ]);
        $this->assertDatabaseHas('item_categories',[
            'item_id' => $item->id,
            'category_id' => ['9','13'],
        ]);
        Storage::disk('public')->assertExists($item->image);
    }
}
